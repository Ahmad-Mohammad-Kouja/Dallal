<?php

namespace App\Enums\Clients;

use BenSampo\Enum\Enum;


final class UserTypes extends Enum
{
  const admin = 'admin';
  const user = 'user';
  const broker = 'broker';
}
