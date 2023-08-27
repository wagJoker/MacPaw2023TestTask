<?php
class ContributorController {
    public function addContribution($request, $response, $args) {
        $data = $request->getParsedBody();

        $collectionId = $args['collection_id'];
        $userName = $data['user_name'];
        $amount = $data['amount'];

        $contributorModel = new ContributorModel();
        $result = $contributorModel->addContribution($collectionId, $userName, $amount);

        if ($result) {
            return $response->withJson(['success' => true, 'message' => 'Contribution added successfully.']);
        } else {
            return $response->withJson(['success' => false, 'message' => 'Failed to add contribution.']);
        }
    }
}
