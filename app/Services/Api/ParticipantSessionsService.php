<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\Services\Http\BaseHttpService;

/**
 * ParticipantSessionsService
 *
 * GraphQL equivalents (developer guide §5):
 *   list()       → listParticipantSessions query       (TODO — guide shows getParticipantSession only)
 *   getById()    → getParticipantSession query
 *   create()     → createParticipantSession mutation
 *   updateById() → TODO: no equivalent defined in developer guide
 *   patchById()  → action-based dispatch:
 *                    START_SELF_ASSESSMENT     → startSelfAssessment mutation
 *                    COMPLETE_SELF_ASSESSMENT  → completeSelfAssessment mutation
 *                    START_NEEDS_ASSESSMENT    → startNeedsAssessment mutation
 *                    COMPLETE_NEEDS_ASSESSMENT → completeNeedsAssessment mutation
 *                    START_VALIDATION_ASSESSMENT → startConfirmation mutation
 *   deleteById() → TODO: no equivalent defined in developer guide
 *
 * @since 2.0
 */
class ParticipantSessionsService extends BaseHttpService
{
    protected string $endpoint = 'participant-sessions';

    // TODO: GraphQL equivalent — listParticipantSessions not documented in developer guide.
    public function list(array $query = [])
    {
        return $this->graphqlNotImplemented('listParticipantSessions');
    }

    public function getById($id, $query = [])
    {
        $gql = 'query GetParticipantSession($id: ID!) {
            getParticipantSession(id: $id) {
                id applicationUid
                selfAssessmentSurveyId selfAssessmentStartedAt selfAssessmentCompletedAt
                needsAssessmentSurveyId needsAssessmentStartedAt needsAssessmentCompletedAt
                confirmationSurveyId confirmationAssessmentStartedAt confirmationAssessmentCompletedAt
            }
        }';

        return $this->graphqlClient->graphql($gql, ['id' => (string) $id]);
    }

    public function create(array $data)
    {
        $gql = 'mutation CreateParticipantSession($input: CreateParticipantSessionInput!) {
            createParticipantSession(input: $input) {
                id editionId
                selfAssessmentSurveyId
            }
        }';

        $input = [
            'participantId'  => (string) ($data['participantId']  ?? ''),
            'applicationUid' => (string) ($data['applicationUid'] ?? ''),
        ];

        if (!empty($data['editionId'])) {
            $input['editionId'] = (string) $data['editionId'];
        }

        return $this->graphqlClient->graphql($gql, ['input' => $input]);
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function updateById($id, array $data)
    {
        return $this->graphqlNotImplemented('updateParticipantSession');
    }

    /**
     * Routes to the correct GraphQL mutation based on the 'action' key in $data.
     * REST action values map to dedicated GraphQL mutations per developer guide §9.
     */
    public function patchById($id, array $data)
    {
        $action = strtoupper((string) ($data['action'] ?? ''));

        switch ($action) {
            case 'START_SELF_ASSESSMENT':
                $gql = 'mutation StartSelfAssessment($id: ID!) {
                    startSelfAssessment(id: $id) {
                        id selfAssessmentSurveyId selfAssessmentStartedAt
                    }
                }';
                return $this->graphqlClient->graphql($gql, ['id' => (string) $id]);

            case 'COMPLETE_SELF_ASSESSMENT':
                $gql = 'mutation CompleteSelfAssessment($id: ID!) {
                    completeSelfAssessment(id: $id) {
                        id selfAssessmentCompletedAt selfAssessmentGraderId
                    }
                }';
                return $this->graphqlClient->graphql($gql, ['id' => (string) $id]);

            case 'START_NEEDS_ASSESSMENT':
                $gql = 'mutation StartNeedsAssessment($id: ID!) {
                    startNeedsAssessment(id: $id) {
                        id needsAssessmentSurveyId needsAssessmentStartedAt
                    }
                }';
                return $this->graphqlClient->graphql($gql, ['id' => (string) $id]);

            case 'COMPLETE_NEEDS_ASSESSMENT':
                $gql = 'mutation CompleteNeedsAssessment($id: ID!) {
                    completeNeedsAssessment(id: $id) {
                        id needsAssessmentCompletedAt
                    }
                }';
                return $this->graphqlClient->graphql($gql, ['id' => (string) $id]);

            case 'START_VALIDATION_ASSESSMENT':
                $gql = 'mutation StartConfirmation($id: ID!) {
                    startConfirmation(id: $id) {
                        id confirmationSurveyId confirmationAssessmentStartedAt
                    }
                }';
                return $this->graphqlClient->graphql($gql, ['id' => (string) $id]);

            default:
                return $this->graphqlNotImplemented("patchParticipantSession[{$action}]");
        }
    }

    /**
     * Complete the needs assessment and save all choice responses in one mutation.
     *
     * @param string $sessionId Remote session UUID.
     * @param array  $responses [['choiceId' => '...', 'priority' => 1], ...]
     * @return object|null Returns completeNeedsAssessment payload or null on error.
     */
    public function completeNeedsAssessmentWithChoices(string $sessionId, array $responses): ?object
    {
        $gql = 'mutation CompleteNeedsAssessment($id: ID!, $input: CompleteNeedsAssessmentInput!) {
            completeNeedsAssessment(id: $id, input: $input) {
                id
                needsAssessmentCompletedAt
            }
        }';

        return $this->graphqlClient->graphql($gql, [
            'id'    => $sessionId,
            'input' => ['responses' => $responses],
        ]);
    }

    /**
     * Fetches the complete session snapshot needed to generate the PDF report.
     * One query replaces the previous multi-step REST + GraphQL fetches.
     *
     * Returns the raw getParticipantSession object containing:
     *   ->selfAssessmentResults->data[0]    (rating scores + ranked temperaments + pattern titles)
     *   ->selfAssessmentResponses->data[]   (mostChoice/leastChoice titles)
     *   ->needsAssessmentResponses->data[]  (choice title + priority)
     *
     * @param string $sessionId Remote participant session UUID.
     * @return object|null
     */
    public function getPDFReportSnapshot(string $sessionId): ?object
    {
        $gql = 'query GetPDFReportSnapshot($id: ID!) {
            getParticipantSession(id: $id) {
                selfAssessmentResults {
                    data {
                        id
                        dSocialRating dSocialRatingScore
                        iSocialRating iSocialRatingScore
                        sSocialRating sSocialRatingScore
                        cSocialRating cSocialRatingScore
                        dHistoricalRating dHistoricalRatingScore
                        iHistoricalRating iHistoricalRatingScore
                        sHistoricalRating sHistoricalRatingScore
                        cHistoricalRating cHistoricalRatingScore
                        dPreferenceRating dPreferenceRatingScore
                        iPreferenceRating iPreferenceRatingScore
                        sPreferenceRating sPreferenceRatingScore
                        cPreferenceRating cPreferenceRatingScore
                        preferenceRankedTemperaments
                        socialPatternTitle
                        historicalPatternTitle
                        preferencePatternTitle
                        coachOverrides{
                            id
							patternTitle
							rankedTemperaments
							dRating dRatingScore   
							iRating iRatingScore 
							sRating sRatingScore
							cRating cRatingScore
						}
                    }
                }
                selfAssessmentResponses {
					data {
						id
						mostChoiceId
						leastChoiceId
						questionPath
						mostChoice { title temperament }
						leastChoice { title temperament }
					}
				}
                needsAssessmentResponses {
                    data {
                        priority
                        choice { title }
                    }
                }
            }
        }';

        $res = $this->graphqlClient->graphql($gql, ['id' => $sessionId]);

        return $res->getParticipantSession ?? null;
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function deleteById($id)
    {
        return $this->graphqlNotImplemented('deleteParticipantSession');
    }
}
