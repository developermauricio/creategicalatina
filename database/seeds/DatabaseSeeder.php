<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // DB::statement('DEFAULT CHARACTER SET utf8;');

        Storage::deleteDirectory('users');
        Storage::deleteDirectory('projects');
        Storage::deleteDirectory('companies');
        Storage::deleteDirectory('typeProject');

        Storage::makeDirectory('users');
        Storage::makeDirectory('projects');
        Storage::deleteDirectory('companies');
        Storage::deleteDirectory('typeProject');
        $this->call(UserTableSeeder::class);


        app()->setLocale('es');

        // Tipos de identificación

        $identTypeEs = ['Pasaporte', 'Cédula de Ciudadania', 'Cédula de Extranjeria'];
        $identTypeEn = ['Passport', 'Citizenship Card', 'Foreigner ID'];
        for ($i = 0; $i < count($identTypeEs); $i++) {
            factory(\App\Model\IdentificationType::class)->create(
                [
                    "name" => $identTypeEs[$i]
                ]
            );
            $typeidentification = \App\Model\IdentificationType::find($i + 1);
            $typeidentification->setTranslation('name', 'en', $identTypeEn[$i]);
            $typeidentification->setTranslation('description', 'en', 'description');
            $typeidentification->save();
        }

        /*=============================================
          CREAMOS EL ADMINISTRADOR DEL SISTEMA
        =============================================*/
        factory(\App\User::class, 1)->create([
            'name' => 'Admin',
            'last_name' => 'Sistema',
            'email' => 'admin@admin.co',
        ])->each(function (\App\User $u) {
            $u->roles()->attach([1]);
        });

        // Categorías para empresas

        $companyCategoryEs = ['Alimentos', 'Restaurantes', 'Comunicación', 'Educación', 'Financiera'];
        $companyCategoryEn = ['Food', 'Restaurants', 'Communications', 'Education', 'Financial'];
        for ($i = 0; $i < count($companyCategoryEs); $i++) {
            factory(\App\Model\CompanyCategory::class)->create(
                [
                    "name" => $companyCategoryEs[$i]
                ]
            );
            $companyCategory = \App\Model\CompanyCategory::find($i + 1);
            $companyCategory->setTranslation('name', 'en', $companyCategoryEn[$i]);
            $companyCategory->setTranslation('description', 'en', 'description');
            $companyCategory->save();
        }

        // Tipo de proyectos
        $imgTypeProject = ['/images/type-projects/img-project-web.png', '/images/type-projects/img-project-software.png',
            '/images/type-projects/img-project-design.png', '/images/type-projects/img-project-marketing.png', '/images/type-projects/img-project-events.png',
        ];
        $typeProjectsEs = ['Desarrollo Web', 'Software', 'Diseño', 'Marketing Digital', 'Eventos',];
        $typeProjectsEn = ['Web Development', 'Software', 'Design', 'Digital Marketing', 'Events'];
        for ($i = 0; $i < count($imgTypeProject); $i++) {
            for ($i = 0; $i < count($typeProjectsEs); $i++) {
                factory(\App\Model\TypeProject::class)->create(["name" => $typeProjectsEs[$i], 'picture' => $imgTypeProject[$i]]);
                $typeProject = \App\Model\TypeProject::find($i + 1);
                $typeProject->setTranslation('name', 'en', $typeProjectsEn[$i]);
                $typeProject->setTranslation('description', 'en', 'description');
                $typeProject->save();
            }
        }

        // Categorias para proyectos
        $imgTypeCategorySoftware = ['/images/project-categories/img-project-category-web-platform.png', '/images/project-categories/img-project-category-mobile-app.png',
            '/images/project-categories/img-project-category-desktop-application.png', '/images/project-categories/img-project-category-ecommerce.png',
        ];
        $typeCategoryProjectSoftwareEs = ['Plataforma Web', 'Aplicación Movil', 'Aplicación de Escritorio', 'Ecommerce'];
        $typeCategoryProjectSoftwareEn = ['Web Platform', 'Mobile App', 'Desktop Application', 'Ecommerce'];
        for ($i = 0; $i < count($imgTypeCategorySoftware); $i++) {
            for ($i = 0; $i < count($typeCategoryProjectSoftwareEs); $i++) {
                factory(\App\Model\ProjectCategory::class)->create(
                    [
                        "name" => $typeCategoryProjectSoftwareEs[$i],
                        "picture" => $imgTypeCategorySoftware[$i],
                        'type_project_id' => 2
                    ]
                );
                $typeCategorySofware = \App\Model\ProjectCategory::find($i + 1);
                $typeCategorySofware->setTranslation('name', 'en', $typeCategoryProjectSoftwareEn[$i]);
                $typeCategorySofware->setTranslation('description', 'en', 'description');
                $typeCategorySofware->save();
            }
        }

        $typeCategoryProjectMarketingEs = ['Marketing', 'Community Manager', 'Pautas', 'Anuncios'];
        $typeCategoryProjectMarketingEn = ['Marketing', 'Community Manager', 'Guidelines', 'Advertisements'];
        for ($i = 0; $i < count($typeCategoryProjectMarketingEs); $i++) {
            factory(\App\Model\ProjectCategory::class)->create(
                [
                    "name" => $typeCategoryProjectMarketingEs[$i],
                    'type_project_id' => 4
                ]
            );
            $typeCategoryMarketing = \App\Model\ProjectCategory::find($i + 5);
            $typeCategoryMarketing->setTranslation('name', 'en', $typeCategoryProjectMarketingEn[$i]);
            $typeCategoryMarketing->setTranslation('description', 'en', 'description');
            $typeCategoryMarketing->save();
        }
    }
}
