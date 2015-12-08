<?php 
$I = new AcceptanceTester($scenario);
$I->wantТo('See that landing page is up');
$I->amOnPage('/');
$I->see('Our CRM');