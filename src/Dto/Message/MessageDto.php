<?php

namespace telegram_client\Dto\Message;

use telegram_client\Dto\RequestInterface;

class MessageDto implements RequestInterface
{
    /*
     * Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     */
    private int|string $chat_id;

    /*
     * Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
     */
    private ?int $message_thread_id;

    /*
     * Text of the message to be sent, 1-4096 characters after entities parsing
     */
    private string $text;

    /*
     * Mode for parsing entities in the message text. See formatting options for more details.
     */
    private ?string $parse_mode;

    /*
     * A JSON-serialized list of special entities that appear in message text, which can be specified instead of parse_mode
     *
     * @var MessageEntity[]|null
     */
    private ?array $entities;

    /*
     * Disables link previews for links in this message
     */
    private ?bool $disable_web_page_preview;

    /*
     * Sends the message silently. Users will receive a notification with no sound.
     */
    private ?bool $disable_notification;

    /*
     * Protects the contents of the sent message from forwarding and saving
     */
    private ?bool $protect_content;

    /*
     * If the message is a reply, ID of the original message
     */
    private ?int $reply_to_message_id;

    /*
     * Pass True if the message should be sent even if the specified replied-to message is not found
     */
    private ?bool $allow_sending_without_reply;

    /*
     * Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     *
     * InlineKeyboardMarkup or ReplyKeyboardMarkup or ReplyKeyboardRemove or ForceReply or null
     */
    private $reply_markup;
}