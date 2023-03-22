<?php

namespace models;

class Attachment
{
    private string $attachmentFile;
    private string $attachmentName;

    /**
     * @param string $attachmentFile
     * @param string $attachmentName
     */

    /**
     * @return string
     */
    public function getAttachmentFile(): string
    {
        return $this->attachmentFile;
    }

    /**
     * @param \TCPDF $attachmentFile
     */
    public function setAttachmentFile(string $attachmentFile): void
    {
        $this->attachmentFile = $attachmentFile;
    }

    /**
     * @return string
     */
    public function getAttachmentName(): string
    {
        return $this->attachmentName;
    }

    /**
     * @param string $attachmentName
     */
    public function setAttachmentName(string $attachmentName): void
    {
        $this->attachmentName = $attachmentName;
    }

    public function __construct(string $attachmentFile, string $attachmentName)
    {
        $this->attachmentFile = $attachmentFile;
        $this->attachmentName = $attachmentName;
    }
}