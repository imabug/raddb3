<?php

namespace App\Mail;

use App\Models\TestDate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SurveyScheduled extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Send an email with a JSON body when a survey is scheduled.  The JSON body will have
     * the following structure:
     * {
     *   "UniqueID": <survey ID>,
     *   "Subject": "Equipment Performance Test",
     *   "StartTime": <survey date timestamp>,
     *   "EdnTime": <survey date timestamp>,
     *   "Body": <machine description>,
     *   "Physicist": <physicist name>,
     *   "Resident": <resident name>,
     *   "Facility": <facility name>,
     *   "Location": <location name>
     * }
     */
    /**
     * Create a new message instance.
     */
    public function __construct(public TestDate $survey)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'RadDBCalendarEvent',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
