<?php
namespace  App\Models;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\YamlFrontMatter\YamlFrontMatter;
class Post
{
    public $Title;

    public $date;

    public $body;

    public $slug;

    public function __construct($Title, $date, $body, $slug )
    {
        $this->Title = $Title;
        $this->date = $date;
        $this->body = $body;
       $this->slug = $slug;
    }

    public static function all()
    {
        return cache()->rememberForever('post.all', function () {
            return collect(File::files(resource_path("posts")))

            ->map(fn($files) => YamlFrontMatter::parseFile($files))
             ->map(fn($document)=>new Post (
              $document->Title,
              $document->date,
              $document->body(),
              $document->slug
             ))
              ->sortBydesc('date');
        });
        
      
    }   

    public static function find($slug)
    {
       return  static ::all()->firstWhere('slug', $slug);

    
    }
    public static function findorFail($slug)
    {
       $post = static ::find ($slug);

       if (! $post){
        throw new ModelNotFoundException();
       }

       return $post;
    }
}