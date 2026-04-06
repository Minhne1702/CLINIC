<?php

class HomeController
{
    private $smarty;
    private $db;

    public function __construct($smarty, $db = null)
    {
        $this->smarty = $smarty;
        $this->db = $db;
    }

    public function index()
    {
        $featured_doctors = $this->getFeaturedDoctors();

        $this->smarty->assign('services',         []);
        $this->smarty->assign('specialties',      []);
        $this->smarty->assign('featured_doctors', $featured_doctors);
        $this->smarty->assign('testimonials',     []);
        $this->smarty->assign('active_page',      'home');

        $this->smarty->display('guest/home.tpl');
    }

    private function getFeaturedDoctors()
    {
        if (!$this->db) {
            return [];
        }

        try {
            $cursor = $this->db->selectCollection('users')->find(
                ['role' => 'doctor', 'isActive' => true],
                ['limit' => 4, 'sort' => ['is_featured' => -1, 'createdAt' => -1]]
            );

            $doctors = [];
            foreach ($cursor as $doc) {
                $profile = isset($doc['doctorProfile']) ? $doc['doctorProfile'] : [];
                $doctors[] = [
                    '_id'          => (string) $doc['_id'],
                    'full_name'    => $doc['full_name'] ?? $doc['fullName'] ?? $doc['name'] ?? 'Bác sĩ',
                    'degree'       => $profile['degree'] ?? 'Bác sĩ',
                    'specialty'    => $profile['specialty'] ?? $profile['specialtyId'] ?? '',
                    'rating'       => $doc['rating'] ?? '5.0',
                    'review_count' => $doc['review_count'] ?? 0,
                    'avatar'       => $doc['avatar'] ?? '',
                    'is_featured'  => (bool) ($doc['is_featured'] ?? false),
                ];
            }
            return $doctors;
        } catch (Exception $e) {
            return [];
        }
    }
}
