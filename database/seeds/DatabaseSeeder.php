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
        Storage::deleteDirectory('archives');

        Storage::makeDirectory('users');
        Storage::makeDirectory('projects');
        Storage::makeDirectory('companies');
        Storage::makeDirectory('typeProject');
        Storage::makeDirectory('archives');

        $this->call(UserTableSeeder::class);
        $this->call(PaymentPlatformsTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);


        app()->setLocale('es');
        // Tipos de empresa
        $companyTypeEs = ['Cliente', 'Proveedor'];
        $companyTypeEn = ['Customer', 'Provider'];

        for ($i = 0; $i < count($companyTypeEs); $i++) {
            factory(\App\Model\CompanyType::class)->create(
                [
                    "name" => $companyTypeEs[$i]
                ]
            );
            $companyType = \App\Model\CompanyType::find($i + 1);
            $companyType->setTranslation('name', 'en', $companyTypeEn[$i]);
            $companyType->save();
        }


        // Tipos de cargos manager
        $positionEs = ['Presidente', 'Gerente', 'CEO'];
        $positionEn = ['President', 'Manager', 'CEO'];

        for ($i = 0; $i < count($positionEs); $i++) {
            factory(\App\Model\PositionManager::class)->create(
                [
                    "name" => $positionEs[$i]
                ]
            );
            $position = \App\Model\PositionManager::find($i + 1);
            $position->setTranslation('name', 'en', $positionEn[$i]);
            $position->save();
        }

        // Tipos de identificaci??n

        $identTypeEs = ['Pasaporte', 'C??dula de Ciudadania', 'C??dula de Extranjeria'];
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


        // Categor??as para empresas

        $companyCategoryEs = ['Alimentos', 'Restaurantes', 'Comunicaci??n', 'Educaci??n', 'Financiera'];
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
        $typeProjectsEs = ['Desarrollo Web', 'Software', 'Dise??o', 'Marketing Digital', 'Eventos',];
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
        $typeCategoryProjectSoftwareEs = ['Plataforma Web', 'Aplicaci??n Movil', 'Aplicaci??n de Escritorio', 'Ecommerce'];
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


        /*=============================================
            TIPOS DE PERSONAS NATURALES O JURIDICAS
        =============================================*/
        $typeEntityEs = ['Es Empresa', 'Es Persona Natural'];
        $typeEntityEn = ['It is company', 'He is a natural person'];

        for ($i = 0; $i < count($typeEntityEs); $i++) {
            factory(\App\Model\TypeEntity::class)->create(
                [
                    "name" => $typeEntityEs[$i],
                ]
            );
            $typeEntity = \App\Model\TypeEntity::find($i + 1);
            $typeEntity->setTranslation('name', 'en', $typeEntityEn[$i]);
            $typeEntity->save();
        }

        /*=============================================
            CREANDO 5 AREAS DE TRABAJO
        =============================================*/
        $work_areaEs = ['Dise??o', 'Tecn??logica', 'Finanzas', 'Servicio al Cliente'];
        $work_areaEn = ['Design', 'Technological', 'Finance', 'Customer Service'];

        for ($i = 0; $i < count($work_areaEs); $i++) {
            factory(\App\Model\WorkArea::class)->create(
                [
                    "name" => $work_areaEs[$i],
                ]
            );
            $typeEntity = \App\Model\WorkArea::find($i + 1);
            $typeEntity->setTranslation('name', 'en', $work_areaEn[$i]);
            $typeEntity->save();
        }

        /*=============================================
            CREAMOS 2 CARGOS DISE??O
        =============================================*/
        $postionMemberDisignEs = ['Dise??ador', 'Gr??fico'];
        $postionMemberDisignEn = ['Designer', 'Graphic'];

        for ($i = 0; $i < count($postionMemberDisignEs); $i++) {
            factory(\App\Model\PositionMember::class)->create(
                [
                    "name" => $postionMemberDisignEs[$i],
                    "work_area_id" => 1
                ]
            );
            $positionMDisgn = \App\Model\PositionMember::find($i + 1);
            $positionMDisgn->setTranslation('name', 'en', $postionMemberDisignEn[$i]);
            $positionMDisgn->save();
        }

        /*=============================================
            CREAMOS 2 CARGOS TECNOLOGIA
        =============================================*/
        $postionMemberTecnoEs = ['Desarrollador Web', 'Analista de Datos'];
        $postionMemberTecnoEn = ['Web Developer', 'Data Analyst'];

        for ($i = 0; $i < count($postionMemberTecnoEs); $i++) {
            factory(\App\Model\PositionMember::class)->create(
                [
                    "name" => $postionMemberTecnoEs[$i],
                    "work_area_id" => 2
                ]
            );
            $positionMTecno = \App\Model\PositionMember::find($i + 3);
            $positionMTecno->setTranslation('name', 'en', $postionMemberTecnoEn[$i]);
            $positionMTecno->save();
        }

        /*=============================================
            CREAMOS 2 CARGOS FINANZAS
        =============================================*/
        $postionMemberFinaEs = ['Contador', 'Asistente Contable', 'Gerente de Negocios'];
        $postionMemberFinaEn = ['Accountant', 'Accounting Assistant', 'Business Manager'];

        for ($i = 0; $i < count($postionMemberFinaEs); $i++) {
            factory(\App\Model\PositionMember::class)->create(
                [
                    "name" => $postionMemberFinaEs[$i],
                    "work_area_id" => 3
                ]
            );
            $positionMFina = \App\Model\PositionMember::find($i + 5);
            $positionMFina->setTranslation('name', 'en', $postionMemberFinaEn[$i]);
            $positionMFina->save();
        }

        /*==========================================================================================
            DATOS PARA LOS TIPOS DE FACTURA
        ==========================================================================================*/

        $invoiceTypeEs = ['Factura', 'Cotizaci??n'];
        $invoiceTypeEn = ['Invoice', 'Quotation'];
        for ($i = 0; $i < count($invoiceTypeEs); $i++) {
            factory(\App\Model\InvoiceType::class)->create(
                [
                    "name" => $invoiceTypeEs[$i],
                ]
            );
            $invoiceType = \App\Model\InvoiceType::find($i + 1);
            $invoiceType->setTranslation('name', 'en', $invoiceTypeEn[$i]);
            $invoiceType->save();
        }

        /*=============================================
            CREAMOS 1 CARGOS SERVICIO AL CLIENTE
        =============================================*/
        $postionMemberServiEs = ['Servicio al Cliente', 'Soporte'];
        $postionMemberServiEn = ['Customer Service', 'Support'];

        for ($i = 0; $i < count($postionMemberServiEs); $i++) {
            factory(\App\Model\PositionMember::class)->create(
                [
                    "name" => $postionMemberServiEs[$i],
                    "work_area_id" => 4
                ]
            );
            $positionMServi = \App\Model\PositionMember::find($i + 8);
            $positionMServi->setTranslation('name', 'en', $postionMemberServiEn[$i]);
            $positionMServi->save();
        }

        /*=============================================
            CREAR BRIEF CON PREGUNTAS
        =============================================*/
        $briefEs = ['Brief Desarrollo Web', 'Brief Software', 'Brief Dise??o', 'Brief Marketing Digital', 'Brief Eventos'];
        $briefEn = ['Brief Web Development', 'Brief Software', 'Brief Design', 'Brief Digital Marketing', 'Brief Events'];
        for ($i = 0; $i < count($briefEs); $i++) {
            factory(\App\Model\Brief::class)->create(
                [
                    'title' => $briefEs[$i],
                    'note' => 'Tenga en cuenta en llenar todo el brief, asi podremos dar respuesta a tu solicitud de manera m??s exacta.',
                    'type_project_id' => $i + 1
                ]
            );
            $brief = \App\Model\Brief::find($i + 1);
            $brief->setTranslation('title', 'en', $briefEn[$i]);
            $brief->setTranslation('note', 'en', 'Keep in mind to fill out the entire brief, so we can respond to your request more accurately.');
            $brief->save();
        }

        $questionsEs = [
            'Describa en detalle el problema',
            'Prop??sito',
            'Descripci??n de procesos de negocio actuales',
            'Entorno tecnol??gico actual',
            'Necesidades del negocio',
            'Alcance del Producto/Software',
            'Funcionalidades del Producto',
            'Especificaci??n de actores del sistema',
            'Requisitos de seguridad',
            'Requrimientos de interfaces externas',
            'Entorno Operativo',
            'Referencias',
            'Anexos (Opcional)'
        ];
        $questionsEn = [
            'Describe the problem in detail',
            'Purpose',
            'Description of current business processes',
            'Current technological environment',
            'Business needs',
            'Product/Software Scope',
            'Product Features',
            'Specification of system actors',
            'Safety requirements',
            'External interface requirements',
            'Operating Environment',
            'References',
            'Annexes (Optional)'
        ];
        $noteQuestionEs = [
            'De a conocer en detalle el problema que usted desea mitigar para el mejoramiento de su empresa.',
            'Describa el nombre o t??tulo del software que se est?? especificando en el documento.',
            'Describa el manejo o funcionalidad que tiene su negocio en este momento.',
            'Describa el entorno que est?? manejando actualmente su negocio, p??gina web, aplicaci??n m??vil, aplicaci??n de escritorio.',
            'Cu??les son los objetivos que desea lograr para el mejoramiento de su empresa con la nueva plataforma tecnol??gica que va adquirir.',
            'Describa cuales son los beneficios que busca para su empresa, a trav??s del software.',
            'Liste las funcionalidades que el software debe realizar.',
            'Describa los posibles actores que manejar?? el sistema.',
            'Describa los aspectos de seguridad para el software tales como acceso al sistema, identificaci??n y autenticaci??n, protecci??n de datos y privacidad.',
            'Describa las caracter??sticas que usted considera necesarias para interactuar con el usuario como colores, estilos y dem??s atributos.',
            'Cual es el entorno en para el manejo del software, p??gina web, aplicaci??n m??vil y dem??s.',
            'Mencione posibles similitudes con otras aplicaciones existentes en el mercado.',
            'Relacione informaci??n adicional que considere oportuna para el desarrollo del software.'
        ];
        $noteQuestionEn = [
            'Make known in detail the problem that you want to mitigate for the improvement of your company.',
            'Describe the name or title of the software being specified in the document.',
            'Describe the management or functionality that your business has at this time.',
            'Describe the environment your business is currently managing, website, mobile app, desktop app.',
            'What are the objectives you want to achieve for the improvement of your company with the new technological platform that you are going to acquire.',
            'Describe what are the benefits you are looking for for your company, through the software.',
            'List the functionalities that the software must perform.',
            'Describe the possible actors that the system will manage.',
            'Describe the security aspects for the software such as system access, identification and authentication, data protection and privacy.',
            'Describe the characteristics that you consider necessary to interact with the user such as colors, styles and other attributes.',
            'What is the environment for managing the software, website, mobile application and others.',
            'Mention possible similarities with other existing applications on the market.',
            'List additional information that you consider appropriate for the development of the software.'
        ];

        for ($i = 0; $i < count($questionsEs); $i++) {
            factory(\App\Model\Question::class)->create(
                [
                    'question' => $questionsEs[$i],
                    'note' => $noteQuestionEs[$i],
                    'brief_id' => 2
                ]);
            $question = \App\Model\Question::find($i + 1);
            $question->setTranslation('question', 'en', $questionsEn[$i]);
            $question->setTranslation('note', 'en', $noteQuestionEn[$i]);
            $question->save();
        }

        /*==========================================================================================
            DATOS NO RELEVANTES DE PRUEBA
        ==========================================================================================*/
        factory(\App\User::class, 1)
            ->create([
                'name' => 'Monica',
                'last_name' => 'Rodriguez',
                'email' => 'monic@creategicalatina.com',
                'picture' => '/images/monica-image.png'
            ])
            ->each(function (\App\User $u) {
                $u->roles()->attach(['3']);
                factory(\App\Model\Team::class, 1)
                    ->create(['user_id' => $u->id])
                    ->each(function (\App\Model\Team $t) {
                        $t->teamPosition()->attach(7);
                    });
            });
        if (env('APP_DEBUG') === true) {
            /*=============================================
                CREANDO 10 EMPRESAS Y 10 REPRESENTANTES
            =============================================*/


            factory(\App\User::class, 10)->create()
                ->each(function (\App\User $u) {
                    $u->roles()->attach(['2']);
                    factory(\App\Model\Customer::class, 1)->create(['user_id' => $u->id, 'type_entitity_id' => 1])
                        ->each(function (\App\Model\Customer $customer) use ($u) {
//                        $logos = [
//                            '/images/logos-companies/img-logo-yamaha.png',
//                            '/images/logos-companies/img-logo-mazda.png',
//                            '/images/logos-companies/img-logo-exito.png',
//                            '/images/logos-companies/img-logo-avianca.png',
//                            '/images/logos-companies/img-logo-pepsi.png',
//                            '/images/logos-companies/img-logo-yamaha.png',
//                            '/images/logos-companies/img-logo-mazda.png',
//                            '/images/logos-companies/img-logo-exito.png',
//                            '/images/logos-companies/img-logo-avianca.png',
//                            '/images/logos-companies/img-logo-pepsi.png'];
//                        $ramdon = Str::random(10);
//                        for ($i = 0; $i < count($logos); $i++) {
                            factory(\App\Model\Company::class, 1)->create(['customer_id' => $customer->id])
                                ->each(function (\App\Model\Company $company) use ($customer) {
                                    factory(\App\Model\Project::class, 3)->create()
                                        ->each(function (\App\Model\Project $p) use ($company, $customer) {
                                            factory(\App\Model\Invoice::class, 2)->create([
                                                'company_id' => $company->id,
                                                'customer_id' => $customer->id,
                                                'user_id' => 2,
                                                'project_id' => $p->id
                                            ])->each(function (\App\Model\Invoice $in) {
                                                factory(\App\Model\InvoiceItems::class, 2)->create([
                                                    'invoice_id' => $in->id
                                                ]);
                                            });

                                            $ramdon = random_int(1, 8);
                                            $p->customer()->attach($customer->id);
                                            $p->company()->attach($company->id);
                                            $p->project_categories()->attach($ramdon);
                                        });
                                });
//                        }
                        });
                });
            /*=============================================
                CREAMOS 10 CLIENTES COMO PERSONA NATURAL
            =============================================*/
            factory(\App\User::class, 10)->create()
                ->each(function (\App\User $u) {
                    $u->roles()->attach(['2']);
                    factory(\App\Model\Customer::class, 1)->create(['user_id' => $u->id, 'type_entitity_id' => 2])
                        ->each(function (\App\Model\Customer $cn) use ($u) {
                            factory(\App\Model\Project::class, 3)->create()
                                ->each(function (\App\Model\Project $p) use ($cn) {

                                    factory(\App\Model\PurchaseOrder::class, 1)->create([
                                        'customer_id' => $cn->id,
                                        'user_id' => 2,
                                        'project_id' => $p->id,
                                        'way_to_pay' => 1

                                    ])->each(function (\App\Model\PurchaseOrder $purch) use ($cn, $p) {
                                        factory(\App\Models\ItemsPurchaseOrder::class, 2)->create([
                                            'purchase_order_id' => $purch->id
                                        ]);
                                        factory(\App\Model\Invoice::class, 1)->create([
                                            'customer_id' => $cn->id,
                                            'user_id' => 2,
                                            'project_id' => $p->id,
                                            'purchase_id' => $purch
                                        ])->each(function (\App\Model\Invoice $in) {
                                            factory(\App\Model\InvoiceItems::class, 2)->create([
                                                'invoice_id' => $in->id
                                            ]);
                                        });
                                    });

                                    $ramdon = random_int(1, 8);
                                    $p->customer()->attach($cn->id);
                                    $p->project_categories()->attach($ramdon);
                                });
                        });
                });

            /*=============================================
                CREANDO 10 PROVEEDORES Y 10 REPRESENTANTES
            =============================================*/
            factory(\App\User::class, 10)->create()
                ->each(function (\App\User $u) {
                    $u->roles()->attach(['4']);
                    factory(\App\Model\Provider::class, 1)->create(['user_id' => $u->id, 'type_entitity_id' => 1])
                        ->each(function (\App\Model\Provider $p) use ($u) {
                            factory(\App\Model\Company::class, 1)->create(['provider_id' => $p->id]);
                        });
                });

            /*=============================================
                CREAMOS 10 CLIENTES COMO PERSONA NATURAL
            =============================================*/
            factory(\App\User::class, 10)->create()
                ->each(function (\App\User $u) {
                    $u->roles()->attach(['4']);
                    factory(\App\Model\Provider::class, 1)->create(['user_id' => $u->id, 'type_entitity_id' => 2]);
                });

            /*=============================================
                CREAMOS 10 MIEMBROS
            =============================================*/
            factory(\App\User::class, 2)->create()
                ->each(function (\App\User $u) {
                    $u->roles()->attach(['3']);
                    factory(\App\Model\Team::class, 1)->create(['user_id' => $u->id])
                        ->each(function (\App\Model\Team $t) {
                            $t->teamPosition()->attach(1);
                            $t->teamTypeProjects()->attach(\App\Model\TypeProject::all()->random()->id);
                        });
                });

            /*=============================================
                CREAMOS 10 MIEMBROS
            =============================================*/
            factory(\App\User::class, 2)->create()
                ->each(function (\App\User $u) {
                    $u->roles()->attach(['3']);
                    factory(\App\Model\Team::class, 1)->create(['user_id' => $u->id])
                        ->each(function (\App\Model\Team $t) {
                            $t->teamPosition()->attach(2);
                            $t->teamTypeProjects()->attach(\App\Model\TypeProject::all()->random()->id);
                        });
                });

            /*=============================================
                CREAMOS 10 MIEMBROS
            =============================================*/
            factory(\App\User::class, 2)->create()
                ->each(function (\App\User $u) {
                    $u->roles()->attach(['3']);
                    factory(\App\Model\Team::class, 1)->create(['user_id' => $u->id])
                        ->each(function (\App\Model\Team $t) {
                            $t->teamPosition()->attach(3);
                            $t->teamTypeProjects()->attach(\App\Model\TypeProject::all()->random()->id);
                        });
                });

            /*=============================================
                CREAMOS 10 MIEMBROS
            =============================================*/
            factory(\App\User::class, 2)->create()
                ->each(function (\App\User $u) {
                    $u->roles()->attach(['3']);
                    factory(\App\Model\Team::class, 1)->create(['user_id' => $u->id])
                        ->each(function (\App\Model\Team $t) {
                            $t->teamPosition()->attach(4);
                            $t->teamTypeProjects()->attach(\App\Model\TypeProject::all()->random()->id);
                        });
                });

            /*=============================================
                CREAMOS 10 MIEMBROS
            =============================================*/
            factory(\App\User::class, 2)->create()
                ->each(function (\App\User $u) {
                    $u->roles()->attach(['3']);
                    factory(\App\Model\Team::class, 1)->create(['user_id' => $u->id])
                        ->each(function (\App\Model\Team $t) {
                            $t->teamPosition()->attach(5);
                            $t->teamTypeProjects()->attach(\App\Model\TypeProject::all()->random()->id);
                        });
                });

            /*=============================================
                CREAMOS 10 MIEMBROS
            =============================================*/
            factory(\App\User::class, 2)->create()
                ->each(function (\App\User $u) {
                    $u->roles()->attach(['3']);
                    factory(\App\Model\Team::class, 1)->create(['user_id' => $u->id])
                        ->each(function (\App\Model\Team $t) {
                            $t->teamPosition()->attach(6);
                            $t->teamTypeProjects()->attach(\App\Model\TypeProject::all()->random()->id);
                        });
                });


            /*=============================================
            CREAMOS 10 MIEMBROS
        =============================================*/
            factory(\App\User::class, 2)->create()
                ->each(function (\App\User $u) {
                    $u->roles()->attach(['3']);
                    factory(\App\Model\Team::class, 1)->create(['user_id' => $u->id])
                        ->each(function (\App\Model\Team $t) {
                            $t->teamPosition()->attach(7);
                            $t->teamTypeProjects()->attach(\App\Model\TypeProject::all()->random()->id);
                        });
                });

            /*=============================================
                CREAMOS 10 MIEMBROS
            =============================================*/
            factory(\App\User::class, 2)->create()
                ->each(function (\App\User $u) {
                    $u->roles()->attach(['3']);
                    factory(\App\Model\Team::class, 1)->create(['user_id' => $u->id])
                        ->each(function (\App\Model\Team $t) {
                            $t->teamPosition()->attach(8);
                            $t->teamTypeProjects()->attach(\App\Model\TypeProject::all()->random()->id);
                        });
                });


        }
    }
}
