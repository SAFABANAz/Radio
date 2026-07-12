<?php

namespace Modules\Wallet\Enums;

enum WalletStatus: string
{
    case ACTIVE = 'active';
    case SUSPENDED = 'suspended';
    case FROZEN = 'frozen';
    case CLOSED = 'closed';
}
