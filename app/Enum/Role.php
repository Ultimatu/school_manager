<?php

namespace App\Enum;

/**
 * Class Role
 * Cette classe contient les roles de l'application
 * @package App\Enum
 */
class Role
{

    const ADMIN = 'admin';
    const ETUDIANT = 'etudiant';
    const CHAUFFEUR = 'chauffeur';
    const RESPONSABLE = 'responsable';
    const SECRETAIRE = 'secretaire';
    const PROFESSEUR = 'professeur';

    const CONSEILLER = 'conseiller';

    public static function getRoles()
    {
        return [
            self::ADMIN,
            self::ETUDIANT,
            self::CHAUFFEUR,
            self::RESPONSABLE,
            self::SECRETAIRE,
            self::PROFESSEUR,
            self::CONSEILLER,
        ];
    }


    public static function rolesAbilities()
    {
        return [
            self::ADMIN => [
                'full_access' => true,

            ],
            self::ETUDIANT => [
                'read' => true,
                'full_access' => false,
            ],
            self::CHAUFFEUR => [
                'read' => true,
                'update' => true,
                'full_access' => false,
            ],
            self::RESPONSABLE => [
                'create' => true,
                'read' => true,
                'update' => true,
                'delete' => true,

            ],
            self::SECRETAIRE => [
                'create' => true,
                'read' => true,
                'update' => true,
                'delete' => true,
            ],
            self::PROFESSEUR => [
                'create' => true,
                'read' => true,
                'update' => true,
                'delete' => true,
            ],
            self::CONSEILLER => [
                'create' => true,
                'read' => true,
                'update' => true,
                'delete' => true,
            ],
        ];
    }


    public static function getAbilities($role): array
    {
        return self::rolesAbilities()[$role];
    }

    public static function roleDescription(){
        return [
            self::ADMIN => 'Administrateur de l\'application',
            self::ETUDIANT => 'Etudiant de l\'universite',
            self::CHAUFFEUR => 'Chauffeur de bus',
            self::RESPONSABLE => 'Responsable de filiere',
            self::SECRETAIRE => 'Secretaire de direction',
            self::PROFESSEUR => 'Professeur',
            self::CONSEILLER => 'Conseiller administratif',
        ];
    }





}
