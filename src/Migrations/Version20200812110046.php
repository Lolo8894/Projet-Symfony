<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200812110046 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("INSERT INTO `utilisateurs` (`id`, `email`, `avatar`, `updated_at`, `username`, `password`, `roles`) VALUES
        (10, 'celinegana.mc@gmail.com', '5f2ae5d62c258_lyline-hello.jpeg', '2020-08-11 19:33:11', 'celstuv', 'RY90BBuieFZg76KfPi4/0A==', 'ROLE_ADMIN'),
        (11, 'exemple@exemple.fr', NULL, '2020-08-05 19:03:36', 'Shini_Lina', 'ToCGBjWuOPMI4HZGzbpcNw==', NULL);
        ");

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
