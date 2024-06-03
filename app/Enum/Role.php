<?php

namespace App\Enum;

/**
 * Class Role
 * Cette classe contient les roles de l'application
 * @package App\Enum
 */
class Role
{

    /**
     * Le role de l'administrateur
     */
    const ADMIN = 'admin';

    /**
     * Le role de l'etudiant
     */
    const ETUDIANT = 'etudiant';

    /**
     * Le role du chauffeur
     */
    const CHAUFFEUR = 'chauffeur';

    /**
     * Le role du responsable
     */
    const RESPONSABLE = 'responsable';

    /**
     * Le role du secretaire
     */
    const SECRETAIRE = 'secretaire';

    /**
     * Le role du professeur
     */
    const PROFESSEUR = 'professeur';

    /**
     * Le role du conseiller
     */
    const CONSEILLER = 'conseiller';


    /**
     * @return array
     */
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


    /**
     * @return array
     */
    public static function rolesAbilities()
    {
        return [
            self::ADMIN => [
                'full_access'
            ],
            self::ETUDIANT => [
                'read',
                'update',
            ],
            self::CHAUFFEUR => [
                'read',
            ],
            self::RESPONSABLE => [
                'create',
                'read',
                'update',
                'delete',
            ],
            self::SECRETAIRE => [
                'create',
                'read',
                'update',
                'delete',
            ],
            self::PROFESSEUR => [
                'create',
                'read',
                'update',
                'delete',
            ],
            self::CONSEILLER => [
                'create',
                'read',
                'update',
                'delete',
            ],
        ];
    }


    /**
     * @param $role
     * @return array
     */
    public static function getAbilities($role): array
    {
        return self::rolesAbilities()[$role];
    }

    /**
     * @return array
     */
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


    /**
     * @param $role
     * @return string
     */
    public static function getRoleDescription($role){
        return self::roleDescription()[$role];
    }

}
