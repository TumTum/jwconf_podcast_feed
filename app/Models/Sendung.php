<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sendung extends Model
{
    protected $fillable = [
        'checksum',
        'pubdate',
        'thema',
        'sender',
        'url',
        'type',
        'length',
    ];

    protected $casts = [
        'pubdate' => 'datetime',
    ];

    public function getChecksum(): string
    {
        return $this->checksum;
    }

    public function getPubdate(): \DateTime
    {
        return $this->pubdate;
    }

    public function getThema(): string
    {
        return $this->thema;
    }

    public function getSender(): string
    {
        return $this->sender;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function getDescription(): string
    {
        return sprintf(
            'Radiosendungen wurde am "%s" ausgestrahlt im "%s"',
            $this->getPubdate()->format('d.m.Y'),
            $this->getSender()
        );
    }


}
