<?php

declare(strict_types=1);

class BlogFeed
{

    /**
     * @var array
     */
    public $posts = array();

    /**
     * BlogFeed constructor.
     *
     * @param string $url Url
     * return void
     */
    public function __construct(string $url) {

        if (!($feeds = simplexml_load_file($url)))
            return;

        echo '<h1>' . $feeds->channel->title . '</h1>';

        foreach ($feeds->channel->item as $item) {

            $post = new BlogPost();
            $post->date = date('D, d M Y', strtotime((string) $item->pubDate));
            $post->link = (string) $item->link;
            $post->title = (string) $item->title;
            $post->text = (string) $item->description;

            // Create summary as a shortened body and remove images,
            // extraneous line breaks, etc.
            $post->summary = $this->summarizeText((string) $post->text);

            $this->posts[] = $post;

        }
    }

    /**
     * Truncate summary line to 100 characters
     *
     * @param string $summary Summary
     * @return string
     */
    private function summarizeText(string $summary): string {

        $summary = strip_tags($summary);
        // Truncate summary line to 100 characters
        $max_len = 100;
        if (strlen($summary) > $max_len)
            $summary = substr($summary, 0, $max_len) . '...';

        return $summary;
    }
}