<?php

declare(strict_types=1);

namespace Malamdg\DiscordPhpClient\Enumeration\Permission;

/**
 * Enum for bot permissions according to Discord API : https://discord.com/developpers/docs/topics/permission#permission-hierarchy
 * Permissions are flags that can be combined as a mask using | operator giving the user's final permission
 *
 * This is a first implementation of bot permission handling may not be change-compliant
 */
enum PermissionEnum: int
{
    /** Allows creation of instant invites */
    case CREATE_INSTANT_INVITATION = (1 << 0); // Scope : V,T,S

    /** Allows kicking members */
    case KICK_MEMBERS = (1 << 1); // Scope : Guild

    /** Allows banning members */
    case BAN_MEMBERS = (1 << 2); // Scope : Guild

    /** Allows all permissions and bypass channel permission overwrites */
    case ADMINISTRATOR = (1 << 3); // Scope : Guild

    /** Allows management and editing of channels */
    case MANAGE_CHANNELS = (1 << 4); // Scope : V,T,S

    /** Allows management and editing of the guild */
    case MANAGE_GUILD = (1 << 5); // Scope : Guild

    /** Allows for the addition of reactions to messages */
    case ADD_REACTIONS = (1 << 6); // Scope : V,T,S

    /** Allows for viewing of audit logs */
    case VIEW_AUDIT_LOG = (1 << 7); // Scope : Guild

    /** Allows for using priority speaker in a voice channel */
    case PRIORITY_SPEAKER = (1 << 8); // Scope : V

    /** Allows the user to go live */
    case STREAM = (1 << 9); // Scope : V,S

    /** Allows guild members to view a channel, which includes reading messages in text channels and joining voice channel */
    case VIEW_CHANNEL = (1 << 10); // Scope : V,T,S

    /** Allows for sending messages in a channel and creating threads in a forum (does not allow sending message in threads) */
    case SEND_MESSAGES = (1 << 11); // Scope : V,T,S

    /** Allows for sending of `/tts` messages */
    case SEND_TTS_MESSAGES = (1 << 12); // Scope : V,T,S - tts stands for text to speech

    /** Allows for deletion of other users messages */
    case MANAGE_MESSAGES = (1 << 13); // Scope : V,T,S

    /** Links sent by users with this permission will be auto-embedded */
    case EMBED_LINKS = (1 << 14); // Scope : V,T,S

    /** Allows for uploading for images and files */
    case ATTACH_FILES = (1 << 15); // Scope : V,T,S

    /** Allows kicking members */
    case READ_MESSAGE_HISTORY = (1 << 16); // Scope : Guild

    /** Allows for using the `@everyone` tag to notify all users in a channel, and the `@here` tag to notify all online users in a channel */
    case MENTION_EVERYONE = (1 << 17); // Scope : V,T,S

    /** Allows the usage of custom emojis from other servers */
    case USE_EXTERNAL_EMOJIS = (1 << 18); // Scope : V,T,S

    /** Allows for viewing guild insights */
    case VIEW_GUILD_INSIGHTS = (1 << 19); // Scope : Guild

    /** Allows for joining voice channel */
    case CONNECT = (1 << 20); // Scope : V,S

    /** Allows for speaking in a voice channel */
    case SPEAK = (1 << 21); // Scope : V

    /** Allows for muting members in a voice channel */
    case MUTE_MEMBERS = (1 << 22); // Scope : V,S

    /** Allows for deafening of members in a voice channel */
    case DEAFEN_MEMBERS = (1 << 23); // Scope : V

    /** Allows for moving of members between voice channels */
    case MOVE_MEMBERS = (1 << 24); // Scope : V,S

    /** Allows for using voice-detecting-detection in a voice channel */
    case USE_VAD = (1 << 25); // Scope : V

    /** Allows for modification of own nickname */
    case CHANGE_NICKNAME = (1 << 26); // Scope : Guild

    /** Allows for modification of other users nicknames */
    case MANAGE_NICKNAMES = (1 << 27); // Scope : Guild

    /** Allows management and editing of roles */
    case MANAGE_ROLES = (1 << 28); // Scope : V,T,S

    /** Allows management and editing of webhooks */
    case MANAGE_WEBHOOKS = (1 << 29); // Scope : V,T,S

    /** Allows for editing and deleting emojis, stickers, and soundboard sounds created by all users */
    case MANAGE_GUILD_EXPRESSIONS = (1 << 30); // Scope : Guild

    /** Allows members to use the application commands, including slash commands and context menu commands */
    case USE_APPLICATION_COMMANDS = (1 << 31); // Scope : V,T,S

    /** Allows for requesting to speak in stage channels. (This permission may be changed or removed) */
    case REQUEST_TO_SPEAK = (1 << 32); // Scope : S

    /** Allows for editing and deleting scheduled events created by all users */
    case MANAGE_EVENTS = (1 << 33); // Scope : V,S

    /** Allows for deleting and archiving threads, and viewing of all private threads */
    case MANAGE_THREADS = (1 << 34); // Scope : T

    /** Allows for creating public and announcement threads */
    case CREATE_PUBLIC_THREADS = (1 << 35); // Scope : T

    /** Allows for creating private threads */
    case CREATE_PRIVATE_THREADS = (1 << 36); // Scope : T

    /** Allows the usage of external stickers from other servers */
    case USE_EXTERNAL_STICKERS = (1 << 37); // Scope : V,T,S

    /** Allows sending messages in threads */
    case SEND_MESSAGE_IN_THREADS = (1 << 38); // Scope : T

    /** Allows for using Activities (applications with the EMBEDDED flag) in a voice channel */
    case USE_EMBEDDED_ACTIVITIES = (1 << 39); // Scope : V

    /** Allows for timing out users to prevent them from sending or reacting to messages in chat and threads, and from speaking in voice and stage channels */
    case MODERATE_MEMBERS = (1 << 40); // Scope : Guild

    /** Allows for viewing role subscription insights */
    case VIEW_CREATOR_MONETIZATION_ANALYTICS = (1 << 41); // Scope : Guild

    /** Allows for using soundboard in a voice channel */
    case USE_SOUNDBOARD = (1 << 42); // Scope : V

    /** Allows for creating emojis, stickers, and soundboard sounds, and editing and deleting those created by the current user. */
    case CREATE_GUILD_EXPRESSIONS = (1 << 43); // Scope : Guild

    /** Allows for creating scheduled events, and editing and deleting those created by the current user */
    case CREATE_EVENTS = (1 << 44); // Scope : V,S

    /** Allows the usage of custom soundboard sounds from other servers */
    case USE_EXTERNAL_SOUNDS = (1 << 45); // Scope : V

    /** Allows sending voice messages */
    case SEND_VOICE_MESSAGES = (1 << 46); // Scope : V,T,S

    /** Allows sending polls */
    case SEND_POLLS = (1 << 49); // Scope : V,T,S

    /** Allows user-installed apps to send public responses. When disabled, users will still be allowed to use their apps but the responses will be ephemeral. This only applies to apps not also installed on the server. */
    case USE_EXTERNAL_APPS = (1 << 50); // Scope : V,T,S

    /**
     * Return the list of permissions for given scope
     *
     * @param PermissionScopeEnum $scope
     *
     * @return PermissionEnum[]
     */
    public static function getByScope(PermissionScopeEnum $scope): array
    {
        return match ($scope) {
            PermissionScopeEnum::GUILD => self::getForGuildScope(),
            PermissionScopeEnum::VOICE_CHANNEL => self::getForVoiceScope(),
            PermissionScopeEnum::TEXT_CHANNEL => self::getForTextScope(),
            PermissionScopeEnum::STAGE_CHANNEL => self::getForStageScope(),
        };
    }

    /**
     * Return the permissions with guild scope ordered by flag value
     *
     * @return PermissionEnum[]
     */
    public static function getForGuildScope(): array {
        return [
            self::KICK_MEMBERS,
            self::BAN_MEMBERS,
            self::ADMINISTRATOR,
            self::MANAGE_GUILD,
            self::VIEW_AUDIT_LOG,
            self::READ_MESSAGE_HISTORY,
            self::VIEW_GUILD_INSIGHTS,
            self::CHANGE_NICKNAME,
            self::MANAGE_NICKNAMES,
            self::MANAGE_GUILD_EXPRESSIONS,
            self::MODERATE_MEMBERS,
            self::VIEW_CREATOR_MONETIZATION_ANALYTICS,
            self::CREATE_GUILD_EXPRESSIONS,
        ];
    }

    public static function getForVoiceScope(): array {
        return [
            self::CREATE_INSTANT_INVITATION,
            self::MANAGE_CHANNELS,
            self::ADD_REACTIONS,
            self::PRIORITY_SPEAKER,
            self::STREAM,
            self::VIEW_CHANNEL,
            self::SEND_MESSAGES,
            self::SEND_TTS_MESSAGES,
            self::MANAGE_MESSAGES,
            self::EMBED_LINKS,
            self::ATTACH_FILES,
            self::MENTION_EVERYONE,
            self::USE_EXTERNAL_EMOJIS,
            self::CONNECT,
            self::SPEAK,
            self::MUTE_MEMBERS,
            self::DEAFEN_MEMBERS,
            self::MOVE_MEMBERS,
            self::USE_VAD,
            self::MANAGE_ROLES,
            self::MANAGE_WEBHOOKS,
            self::USE_APPLICATION_COMMANDS,
            self::MANAGE_EVENTS,
            self::USE_EXTERNAL_STICKERS,
            self::USE_EMBEDDED_ACTIVITIES,
            self::USE_SOUNDBOARD,
            self::CREATE_EVENTS,
            self::USE_EXTERNAL_SOUNDS,
            self::SEND_VOICE_MESSAGES,
            self::SEND_POLLS,
            self::USE_EXTERNAL_APPS,
        ];
    }

    public static function getForTextScope(): array {
        return [
            self::CREATE_INSTANT_INVITATION,
            self::MANAGE_CHANNELS,
            self::ADD_REACTIONS,
            self::VIEW_CHANNEL,
            self::SEND_MESSAGES,
            self::SEND_TTS_MESSAGES,
            self::MANAGE_MESSAGES,
            self::EMBED_LINKS,
            self::ATTACH_FILES,
            self::MENTION_EVERYONE,
            self::USE_EXTERNAL_EMOJIS,
            self::MANAGE_ROLES,
            self::MANAGE_WEBHOOKS,
            self::USE_APPLICATION_COMMANDS,
            self::MANAGE_THREADS,
            self::CREATE_PUBLIC_THREADS,
            self::CREATE_PRIVATE_THREADS,
            self::USE_EXTERNAL_STICKERS,
            self::SEND_MESSAGE_IN_THREADS,
            self::SEND_VOICE_MESSAGES,
            self::SEND_POLLS,
            self::USE_EXTERNAL_APPS,
        ];
    }

    public static function getForStageScope(): array {
        return [
            self::CREATE_INSTANT_INVITATION,
            self::MANAGE_CHANNELS,
            self::ADD_REACTIONS,
            self::STREAM,
            self::VIEW_CHANNEL,
            self::SEND_MESSAGES,
            self::SEND_TTS_MESSAGES,
            self::MANAGE_MESSAGES,
            self::EMBED_LINKS,
            self::ATTACH_FILES,
            self::MENTION_EVERYONE,
            self::USE_EXTERNAL_EMOJIS,
            self::CONNECT,
            self::MUTE_MEMBERS,
            self::MOVE_MEMBERS,
            self::MANAGE_ROLES,
            self::MANAGE_WEBHOOKS,
            self::USE_APPLICATION_COMMANDS,
            self::REQUEST_TO_SPEAK,
            self::MANAGE_EVENTS,
            self::USE_EXTERNAL_STICKERS,
            self::CREATE_EVENTS,
            self::SEND_VOICE_MESSAGES,
            self::SEND_POLLS,
            self::USE_EXTERNAL_APPS,
        ];
    }
}
