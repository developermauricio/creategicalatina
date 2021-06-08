<?php

namespace App\Mail\Project;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewProjectCustomer extends Mailable
{
    use Queueable, SerializesModels;
    private $user_name;
    private $company;
    private $project_name;
    private $url_project;
    private $observations_project;
    private $type_project;
    private $categories_project;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_name, $company, $project_name, $url_project, $observations_project, $type_project, $categories_project)
    {
        $this->user_name = $user_name;
        $this->company = $company;
        $this->project_name = $project_name;
        $this->url_project = $url_project;
        $this->observations_project = $observations_project;
        $this->type_project = $type_project;
        $this->categories_project = $categories_project;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(config('app.name').'-'. 'NUEVO PROYECTO REGISTRADO')
            ->markdown('email.project.new-project-customer')
            ->with('name',$this->user_name)
            ->with('company',$this->company)
            ->with('project_name',$this->project_name)
            ->with('url_project',$this->url_project)
            ->with('observation',$this->observations_project)
            ->with('type_project',$this->type_project)
            ->with('categories_project',$this->categories_project);
    }
}
