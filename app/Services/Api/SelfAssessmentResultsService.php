<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\Services\Http\BaseHttpService;

/**
 * SelfAssessmentResultsService
 *
 * GraphQL equivalents (developer guide §6.1, §6.2):
 *   list()    → getParticipantSession { selfAssessmentResults } (the engine has no listSelfAssessmentResults)
 *   getById() → getSelfAssessmentResult query
 *
 * @since 2.0
 */
class SelfAssessmentResultsService extends BaseHttpService
{
    protected string $endpoint = 'self-assessment-results';

    /**
     * List the self-assessment results of one participant session.
     *
     * The scoring engine has no top-level listSelfAssessmentResults query and no
     * result filter type: results are listed only through
     * getParticipantSession(id) { selfAssessmentResults(limit, offset) }.
     *
     * @param array $query participantSessionId (required, remote session UUID), limit, offset (optional ints).
     * @return object|null {total, offset, limit, data[]}, or null when the session id is missing,
     *                     the session is not found, or the call fails (see getLastError()).
     */
    public function list(array $query = [])
    {
        $sessionId = trim((string) ($query['participantSessionId'] ?? ''));
        if ($sessionId === '') {
            return null;
        }

        $gql = 'query ListSessionSelfAssessmentResults($id: ID!, $limit: Int, $offset: Int) {
            getParticipantSession(id: $id) {
                selfAssessmentResults(limit: $limit, offset: $offset) {
                    total offset limit
                    data {
                        id
                        preferencePatternTitle
                        socialRankedTemperaments historicalRankedTemperaments preferenceRankedTemperaments
                        dMostCount dLeastCount dDiff
                        iMostCount iLeastCount iDiff
                        sMostCount sLeastCount sDiff
                        cMostCount cLeastCount cDiff
                    }
                }
            }
        }';

        $variables = ['id' => $sessionId];
        if (isset($query['limit']) && is_numeric($query['limit'])) {
            $variables['limit'] = (int) $query['limit'];
        }
        if (isset($query['offset']) && is_numeric($query['offset'])) {
            $variables['offset'] = (int) $query['offset'];
        }

        $res = $this->graphqlClient->graphql($gql, $variables);

        return $res->getParticipantSession->selfAssessmentResults ?? null;
    }

    public function getById($id, $query = [])
    {
        $gql = 'query GetSelfAssessmentResult($id: ID!) {
            getSelfAssessmentResult(id: $id) {
                id
                preferencePatternTitle
                socialRankedTemperaments historicalRankedTemperaments preferenceRankedTemperaments
                dMostCount dLeastCount dDiff
                iMostCount iLeastCount iDiff
                sMostCount sLeastCount sDiff
                cMostCount cLeastCount cDiff
            }
        }';

        return $this->graphqlClient->graphql($gql, ['id' => (string) $id]);
    }

    /**
     * Fetch the full self-assessment result for a session, including all chart fields.
     * Used by NeedsAssessmentCompleteController for server-side chart generation.
     *
     * @param string $sessionId Remote participant session UUID.
     * @return object|null First matching result object, or null on error / no data.
     */
    public function getBySessionId(string $sessionId): ?object
    {
        $gql = 'query GetSessionResult($id: ID!) {
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
                        socialRankedTemperaments
                        historicalRankedTemperaments
                        preferenceRankedTemperaments
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
            }
        }';

        $res = $this->graphqlClient->graphql($gql, ['id' => $sessionId]);

        return $res->getParticipantSession->selfAssessmentResults->data[0] ?? null;
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function create(array $data)
    {
        return $this->graphqlNotImplemented('createSelfAssessmentResult');
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function updateById($id, array $data)
    {
        return $this->graphqlNotImplemented('updateSelfAssessmentResult');
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function patchById($id, array $data)
    {
        return $this->graphqlNotImplemented('patchSelfAssessmentResult');
    }

    // TODO: No GraphQL equivalent defined in developer guide.
    public function deleteById($id)
    {
        return $this->graphqlNotImplemented('deleteSelfAssessmentResult');
    }
}
