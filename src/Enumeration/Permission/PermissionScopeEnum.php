<?php

declare(strict_types=1);

namespace Malamdg\DiscordPhpClient\Enumeration\Permission;

/**
 * Part of the permission implementation - may be changed later for a more change-compliant iteration
 */
enum PermissionScopeEnum: string
{
    case GUILD = "Guild"; // Server-wide
    case VOICE_CHANNEL = "V";
    case TEXT_CHANNEL = "T";
    case STAGE_CHANNEL = "S";
}
