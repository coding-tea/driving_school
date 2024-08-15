<?php

namespace Tests\Browser;


use Laravel\Dusk\Browser;
use Tests\Browser\Pages\LoginPage;
use Tests\DuskTestCase;

class ProjectPhaseTest extends DuskTestCase
{
    // create validation
    public function test_check_create_project_phase_validation_fields()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit(new LoginPage)
                ->loginUser('test', "test")
                ->visit("https://atlecs.net/gdd/public/project_phases/create")
                ->waitForLocation("https://atlecs.net/gdd/public/project_phases/create")
                ->assertSee("Créer une nouvelle phase de projet")
                ->waitFor('button.app-button.btn.btn-primary', 30)
                ->scrollIntoView('button.app-button.btn.btn-primary')
                ->press("Enregistrer")
                ->scrollIntoView('.card-title')
                ->pause(5000);
        });
    }

    // insert required fields
    public function test_create_project_phase_by_inserting_just_required_fields()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit("https://atlecs.net/gdd/public/project_phases/create")
                ->waitForLocation("https://atlecs.net/gdd/public/project_phases/create")
                ->assertSee("Créer une nouvelle phase de projet")
                ->type('code', "3333")
                ->type('title', "3333")
                ->type('color', "3333")
                ->select('nature_project', "2")
                ->scrollIntoView('button.app-button.btn.btn-primary')
                ->press("Enregistrer")
                ->scrollIntoView('.card-title')
                ->pause(5000);
        });
    }

    //update test
    public function test_check_update_project_phase()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit("https://atlecs.net/gdd/public/project_phases")
                ->waitForLocation("https://atlecs.net/gdd/public/project_phases")
                ->waitFor('.pagination', 30)
                ->scrollIntoView('.pagination')
                ->waitFor('.pagination li:last-child .page-link', 30)
                ->click('.pagination li:last-child .page-link')
                ->waitFor('tbody tr:last-child td:last-child', 30)
                ->click('tbody tr:last-child td:last-child')
                ->assertSee("Actions")
                ->clickLink("Edit")
                ->waitForText("Modifier une phase de projet", 30)
                ->assertSee("Modifier une phase de projet")
                ->type('code', "update code")
                ->type('title', "update title")
                ->type('color', "update color")
                ->select('nature_project', "2")
                ->type("observations", "update observation")
                ->type("description", "update description")
                ->scrollIntoView('button.app-button.btn.btn-primary')
                ->press("Enregistrer")
                ->scrollIntoView('.card-title')
                ->pause(5000);
        });
    }

    // update validation
    public function test_check_update_project_phase_validation_fields()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit("https://atlecs.net/gdd/public/project_phases")
                ->waitForLocation("https://atlecs.net/gdd/public/project_phases")
                ->waitFor('.pagination', 30)
                ->scrollIntoView('.pagination')
                ->waitFor('.pagination li:last-child .page-link', 30)
                ->click('.pagination li:last-child .page-link')
                ->waitFor('tbody tr:last-child td:last-child', 30)
                ->click('tbody tr:last-child td:last-child')
                ->assertSee("Actions")
                ->clickLink("Edit")
                ->waitForText("Modifier une phase de projet", 30)
                ->assertSee("Modifier une phase de projet")
                ->type('code', "")
                ->type('title', "")
                ->type('color', "")
                ->select('nature_project', "")
                ->scrollIntoView('button.app-button.btn.btn-primary')
                ->press("Enregistrer")
                ->scrollIntoView('.card-title')
                ->pause(5000);
        });
    }

    //delete test
    public function test_delete_project_phase()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit("https://atlecs.net/gdd/public/project_phases")
                ->waitForLocation("https://atlecs.net/gdd/public/project_phases")
                ->waitFor('.pagination')
                ->scrollIntoView('.pagination')
                ->waitFor('.pagination li:last-child .page-link', 30)
                ->click('.pagination li:last-child .page-link')
                ->waitFor('tbody tr:last-child td:last-child', 30)
                ->click('tbody tr:last-child td:last-child')
                ->assertSee("Actions")
                ->clickLink("Delete")
                ->waitForText('Phase de projet supprimée avec succès', 30)
                ->pause(1000)
                ->press('Terminé')
                ->pause(5000);
        });
    }


    //test download
    public function test_download_project_phases_file()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit("https://atlecs.net/gdd/public/project_phases")
                ->waitForLocation("https://atlecs.net/gdd/public/project_phases")
                ->waitFor('#kt_app_content_container > div > div > div.card.mt-3 > div', 30)
                ->scrollIntoView('#kt_app_content_container > div > div > div.card.mt-3 > div')
                ->assertSee("Télécharger")
                ->clickLink("Télécharger")
                ->pause(5000);
        });
    }

    // test import
    public function test_import_project_phases_data()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit("https://atlecs.net/gdd/public/project_phases")
                ->waitForLocation("https://atlecs.net/gdd/public/project_phases")
                ->waitFor('#kt_app_content_container > div > div > div.card.mt-3 > div', 30)
                ->scrollIntoView('#kt_app_content_container > div > div > div.card.mt-3 > div')
                ->attach('file', public_path('tests/projects_phases/project_phases.xlsx'))
                ->select("nature_project", 2)
                ->press("Sauvegarder")
                ->waitForText('Les phases de projets ont été ajoutées avec succès', 30)
                ->pause(1000)
                ->press('Terminé')
                // ->click('.pagination li:last-child .page-link')
                // ->scrollIntoView('.card-header')
                ->pause(5000);
        });
    }

    // search the new tests projects phases
    public function test_search_for_new_projects_phases()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit("https://atlecs.net/gdd/public/project_phases")
                ->waitForLocation("https://atlecs.net/gdd/public/project_phases")
                ->type('div.card-header.border-0.pt-6 > div.card-title > div > input', "test")
                ->pause(5000);
        });
    }

    // test export
    public function test_export_project_phases_data()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit("https://atlecs.net/gdd/public/project_phases")
                ->waitForLocation("https://atlecs.net/gdd/public/project_phases")
                ->waitFor('#kt_app_content_container > div > div > div.card.mt-3 > div', 30)
                ->scrollIntoView('#kt_app_content_container > div > div > div.card.mt-3 > div')
                ->clickLink("Export")
                ->pause(5000);
        });
    }

    // test destroy group
    public function test_destroy_group()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit("https://atlecs.net/gdd/public/project_phases")
                ->waitForLocation("https://atlecs.net/gdd/public/project_phases")
                ->waitFor('.pagination', 30)
                ->scrollIntoView('.pagination')
                ->waitFor('.pagination li:last-child .page-link', 30)
                ->click('.pagination li:last-child .page-link')
                ->scrollIntoView('tbody > tr:nth-child(1)')
                ->waitFor('tbody > tr:nth-child(1)', 30)
                ->assertSee('Actions')
                ->pause(1000)
                ->check("tbody > tr:nth-child(4) > td:nth-child(1) > div > input")
                ->check("tbody > tr:nth-child(7) > td:nth-child(1) > div > input")
                ->check("tbody > tr:nth-child(5) > td:nth-child(1) > div > input")
                ->clickLink("Actions")
                ->waitForText("Supprimer la sélection", 30)
                ->clickLink("Supprimer la sélection")
                ->waitForText('Supprimer', 30)
                ->pause(1000)
                ->press('Supprimer')
                ->pause(5000);
        });
    }
}