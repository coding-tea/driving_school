<?php

return [

    // pages
    'page_index' => [
        'page_title' => 'Liste des utilisateurs',
        'page_dt_action_delete_all' => 'Supprimer les utilisateurs sélectionnés',
        'page_th_user' => 'Utilisateur',
    ],

    'page_create' => [
        'page_title' => 'Créer un nouvel utilisateur',
        'page_form_card_title' => "Les informations  d'utilisateur",
    ],

    'page_edit' => [
        'page_title' => 'Modifier l\'utilisateur',
        'page_title_with_user' => 'Modifier :user',
    ],

    'page_affectation' => [
        'page_title' => "Affectation des Profiles",
        'collaborator' => "collaborator",
        'affected_profiles' => "Profils Affectés.",
        'un_affected_profiles' => "Profils Non  Affectés.",
        'profiles_affected_notification' => 'Les profils sont affectés avec succès',
    ],
    'account_infos' => 'Les informations  de compte',

    // alerts
    'created_notification' => 'Utilisateur créé avec succès',
    'updated_notification' => 'Utilisateur mis à jour avec succès',
    'deleted_notification' => 'Utilisateur supprimé avec succès',
    'selected_deleted_notification' => 'Utilisateurs supprimés avec succès',
    'status_updated' => 'Mise à jour du statut de l\'utilisateur réussie',
    'role_updated' => 'Mise à jour du rôle de l\'utilisateur réussie',
    'password_initialized' => 'Mot de passe de l\'utilisateur initialisé avec succès',

    // enums
    'status' => [
        'active' => 'Actif',
        'inactive' => 'Inactif',
        'blocked' => 'Bloqué',
    ],

    'civility' => [
        'single' => 'Célibataire',
        'married' => 'Marié',
        'divorced' => 'Divorcé',
        'widowed' => 'Veuf',
    ],

    'roles' => [
        'super_admin' => 'Super Admin',
        'admin' => 'Admin',
        'manager' => 'Manager',
        'engineer' => 'Ingénieur',
        'conseille' => 'Conseiller',
        'administrative_agent' => 'Agent Administratif',
        'enseignant' => 'enseignant',
        'other' => 'Autres',
    ],
];
