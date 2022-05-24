<?php

namespace App\Controller\Admin;

use App\Entity\Screenshot;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use Symfony\Component\Cache\Adapter\TagAwareAdapter;

class ScreenshotCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Screenshot::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield AssociationField::new('user', 'Пользователь');
        yield DateTimeField::new('uploadDate', 'Дата загрузки');
        yield TextareaField::new('uuid', 'uuid');
        yield TextareaField::new('pathToSource', 'путь до файла');
        yield TextareaField::new('extension', 'расширение');
        yield TextareaField::new("description", 'Описание');

    }

}
