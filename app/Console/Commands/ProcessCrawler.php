<?php

namespace App\Console\Commands;

use App\Core\JWConfPage;
use App\Core\MediaData;
use App\DAO\SendungData;
use App\Models\Sendung;
use Illuminate\Console\Command;
use Wa72\HtmlPageDom\HtmlPageCrawler;

class ProcessCrawler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-crawler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $htmlPageCrawler = HtmlPageCrawler::create(JWConfPage::getHTML());
        $htmlPageCrawler->filter("table > tbody > tr")->each(function (HtmlPageCrawler $dom, $index) {
            $this->addSendung($dom);
            print '.';
        });
    }

    protected function addSendung($dom)
    {
        $sendungData = new SendungData();

        $dom->filter('td')->each(function (HtmlPageCrawler $dom, $index) use ($sendungData) {
            $column = [
                'getDomPubdate',
                'getDomThema',
                'getDomSender',
            ];
            call_user_func_array([$this, $column[$index]], [$dom, $sendungData]);
        });

        if (Sendung::where('checksum', $sendungData->getChecksum())->exists() === false) {
            $this->addToDb($sendungData);
        }
    }

    /**
     * @param Sendung $sendungData
     */
    protected function addToDb(SendungData $sendungData)
    {
        MediaData::fetchLengthAndType($sendungData);

        Sendung::create([
            'checksum' => $sendungData->getChecksum(),
            'pubdate' => $sendungData->getPubdate(),
            'thema' => $sendungData->getThema(),
            'sender' => $sendungData->getSender(),
            'url' => $sendungData->getUrl(),
            'type' => $sendungData->getType(),
            'length' => $sendungData->getLength(),
        ]);
    }

    protected function getDomPubdate(HtmlPageCrawler $dom, SendungData $sendungData)
    {
        $date = $dom->getInnerHtml();
        $sendungData->setPubdate($date);
    }

    protected function getDomThema(HtmlPageCrawler $dom, SendungData $sendungData)
    {
        $mediaLink = $dom->filter('a');

        $sendungData->setThema($mediaLink->getInnerHtml());
        $sendungData->setHref($mediaLink->attr('href'));
    }

    protected function getDomSender(HtmlPageCrawler $dom, SendungData $sendungData)
    {
        $sendungData->setSender($dom->getInnerHtml());
    }
}
