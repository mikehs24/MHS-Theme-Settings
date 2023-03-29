<?php

namespace Mhs\Admin;

interface PageInterface
{
    public function addSettingsPage();

    public function save(): void;

    public function pageHtml(): void;
}