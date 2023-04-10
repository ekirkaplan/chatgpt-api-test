<?php

namespace App\Repositories;

use App\Contracts\PrompInterface;
use App\Jobs\PromDatabaseSaveJob;
use App\Models\Promp;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class PrompRepository implements PrompInterface
{
    /**
     * @var string
     */
    private string $apiKey = "apikey-adsfasdfasdfasdf";

    /**
     * @param string $promp
     * @return Promp|array
     */
    public function getPromp(string $promp): Promp|array
    {
        $prompDb = Promp::where('promp', $promp)->first();

        if (is_null($prompDb)) {
            return $this->getPromp($promp);
        }

        return $prompDb;
    }

    public function getAll(): Collection
    {
        return Promp::all();
    }


    /**
     * @param string $prompt
     * @return \Psr\Http\Message\StreamInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getResponseFromOpenAI(string $prompt)
    {
        $client = new Client([
            'headers' => [
                'Authorization' => $this->apiKey,
                'Content-Type' => 'application/json',
            ]
        ]);

        $response = $client->post('https://api.openai.com/v1/engines/davinci-codex/completions', [
            'json' => [
                'prompt' => $prompt,
                'max_tokens' => 1000,
                'temperature' => 0.5,
                'n' => 1,
                'stop' => '\n'
            ]
        ]);

        $delay = now()->addMinutes(60);
        dispatch(new PromDatabaseSaveJob($response->getBody()))->delay($delay);

        return $response->getBody();
    }
}
