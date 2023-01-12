<?php

declare(strict_types=1);

namespace App\Tests\Behat\Page\Backend\Book;

use Monofony\Bridge\Behat\Behaviour\NamesIt;
use Monofony\Bridge\Behat\Crud\AbstractCreatePage;
final class CreatePage extends AbstractCreatePage
{
    use NamesIt;
    public function getRouteName(): string
    {
        return 'app_backend_book_create';
    }

    protected function getDefinedElements(): array
    {
        return [
            'name' => '#book_name',
        ];
    }
}
