<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\LoginPage;
use Tests\DuskTestCase;

class NatureContractTest extends DuskTestCase
{
    /**
     * Test for request validation.
     */
    public function nature_contract_validation(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new LoginPage)
                ->loginUser('test', "test")
                ->visit("http://127.0.0.1:8000/nature-contrats/create")
                ->waitForLocation("http://127.0.0.1:8000/nature-contrats/create")
                ->assertSee("Créer une nature de contrat")
                ->waitFor('button.app-button.btn.btn-primary')
                ->scrollIntoView('button.app-button.btn.btn-primary')
                ->press("Enregistrer")
                ->scrollIntoView('.card-title')
                ->pause(5000);
        });
    }


    /**
     * Test for create a row.
     */
    public function nature_contract_insert()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit("http://127.0.0.1:8000/nature-contrats/create")
                ->waitForLocation("http://127.0.0.1:8000/nature-contrats/create")
                ->assertSee("Créer une nature de contrat")
                ->type('name', "example name")
                ->type('description', "example description")
                ->scrollIntoView('button.app-button.btn.btn-primary')
                ->press("Enregistrer")
                ->scrollIntoView('.card-title')
                ->pause(5000);
        });
    }


    /**
     * Test for update a row.
     */
    public function nature_contract_update()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit("http://127.0.0.1:8000/nature-contrats")
                ->waitForLocation("http://127.0.0.1:8000/nature-contrats")
                ->waitFor('.pagination')
                ->scrollIntoView('.pagination')
                ->waitFor('.pagination li:last-child .page-link')
                ->click('.pagination li:last-child .page-link')
                ->waitFor('tbody tr:last-child td:last-child')
                ->click('tbody tr:last-child td:last-child')
                ->assertSee("Actions")
                ->clickLink("Edit")
                ->waitForText("Modifier :nature de contrat")
                ->assertSee("Modifier :nature de contrat")
                ->type('name', "example updated name")
                ->type('description', "example updated description")
                ->scrollIntoView('button.app-button.btn.btn-primary')
                ->press("Enregistrer")
                ->scrollIntoView('.card-title')
                ->pause(5000);
        });
    }


    /**
     * Test for validation when update.
     */
    public function nature_contract_validation_update()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit("http://127.0.0.1:8000/nature-contrats")
                ->waitForLocation("http://127.0.0.1:8000/nature-contrats")
                ->waitFor('.pagination')
                ->scrollIntoView('.pagination')
                ->waitFor('.pagination li:last-child .page-link')
                ->click('.pagination li:last-child .page-link')
                ->waitFor('tbody tr:last-child td:last-child')
                ->click('tbody tr:last-child td:last-child')
                ->assertSee("Actions")
                ->clickLink("Edit")
                ->waitForText("Modifier :nature de contrat")
                ->assertSee("Modifier :nature de contrat")
                ->type('name', "")
                ->type('description', "")
                ->scrollIntoView('button.app-button.btn.btn-primary')
                ->press("Enregistrer")
                ->scrollIntoView('.card-title')
                ->pause(5000);
        });
    }


    /**
     * Test for delete a row.
     */
    public function nature_contact_delete()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit("http://127.0.0.1:8000/nature-contrats")
                ->waitForLocation("http://127.0.0.1:8000/nature-contrats")
                ->waitFor('.pagination')
                ->scrollIntoView('.pagination')
                ->waitFor('.pagination li:last-child .page-link')
                ->click('.pagination li:last-child .page-link')
                ->waitFor('tbody tr:last-child td:last-child')
                ->click('tbody tr:last-child td:last-child')
                ->assertSee("Actions")
                ->clickLink("Delete")
                ->waitForText('Nature de contrat supprimée avec succès')
                ->pause(1000)
                ->press('Terminé')
                ->pause(5000);
        });
    }


    /**
     * Test for download Excel model.
     */
    public function nature_conract_download_excel()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit("http://127.0.0.1:8000/nature-contrats")
                ->waitForLocation("http://127.0.0.1:8000/nature-contrats")
                ->scrollIntoView('div > div > div.col-12.row.card-body.text-center > div:nth-child(3)')
                ->assertSee("Télécharger")
                ->clickLink("Télécharger")
                ->pause(5000);
        });
    }


    /**
     * Test for import from Excel to db.
     */
    public function nature_conract_import_excel()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit("http://127.0.0.1:8000/nature_conract_download_excel")
                ->waitForLocation("http://127.0.0.1:8000/nature_conract_download_excel")
                ->waitFor('div > div > div.col-12.row.card-body.text-center > div:nth-child(3)')
                ->scrollIntoView('div > div > div.col-12.row.card-body.text-center > div:nth-child(3)')
                ->attach('file', public_path('tests/'))
                ->press("Sauvegarder")
                ->waitForText('enregistrement ajouté avec succès')
                ->pause(1000)
                ->press('Terminé')
                ->click('.pagination li:last-child .page-link')
                ->scrollIntoView('.card-header')
                ->pause(5000);
        });
    }


    /**
     * Test for export from db to Excel.
     */
    public function nature_conract_export_excel()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit("http://127.0.0.1:8000/nature-contrats")
                ->waitForLocation("http://127.0.0.1:8000/nature-contrats")
                ->waitFor('div > div > div.col-12.row.card-body.text-center > div:nth-child(3)')
                ->scrollIntoView('div > div > div.col-12.row.card-body.text-center > div:nth-child(3)')
                ->clickLink("Export dataTable")
                ->pause(5000);
        });
    }


    /**
     * Test for delete multiple line of data-table.
     */
    public function test_destroy_group()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit("http://127.0.0.1:8000/nature-contrats")
                ->waitForLocation("http://127.0.0.1:8000/nature-contrats")
                ->waitFor('.pagination')
                ->scrollIntoView('.pagination')
                ->waitFor('.pagination li:last-child .page-link')
                ->click('.pagination li:last-child .page-link')
                ->scrollIntoView('tbody > tr:nth-child(1)')
                ->waitFor('tbody > tr:nth-child(1)')
                ->assertSee('Actions')
                ->pause(1000)
                ->check("tbody > tr:nth-child(4) > td:nth-child(1) > div > input")
                ->check("tbody > tr:nth-child(7) > td:nth-child(1) > div > input")
                ->check("tbody > tr:nth-child(5) > td:nth-child(1) > div > input")
                ->clickLink("Actions")
                ->waitForText("Supprimer la sélection")
                ->clickLink("Supprimer la sélection")
                ->waitForText('Supprimer')
                ->pause(1000)
                ->press('Supprimer')
                ->pause(5000);
        });
    }
}
