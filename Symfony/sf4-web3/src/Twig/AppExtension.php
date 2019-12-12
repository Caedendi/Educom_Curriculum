<?php

namespace App\Twig;

use App\Entity\User;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AppExtension extends AbstractExtension
{
    private $templating;

    public function getFilters()
    {
        return array(
            new TwigFilter("showUPC", array($this, 'showUPC'))
        );
    }

    public function showUPC(User $user = null)
        // WAAROM?! waarom moet hij een default waarde null hebben en geeft hij anders een error dat hij een instantie van /entity/user verwacht ipv null?
    {
        $html = "<div class=\"user-profile-card\">" . PHP_EOL;
        if ($user == null) {
            return
                $html .
                    "<p>User not found.</p>" . PHP_EOL .
                "</div>" . PHP_EOL;
        }
        else {
            $id = $user->getId();
            $username = $user->getUsername();
            $email = $user->getEmail();
            $login = $user->getLastLogin()->format('Y-m-d H:i:s');
            return
                $html .
                    "<ul>" . PHP_EOL .
                        "<li>User ID: $id</li>" . PHP_EOL .
                        "<li>Username: $username</li>" . PHP_EOL .
                        "<li>Email: $email</li>" . PHP_EOL .
                        "<li>Last login on $login.</li>" . PHP_EOL .
                    "</ul>" . PHP_EOL .
                "</div>"
            ;
        }
    }
}

// Test je code in Twig met:
// {{ user | showEmoji }}