namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZChapter extends Model
{
    protected $table = 'z_chapters';
    protected $fillable = ['chapter_title', 'chapter_details', 'chapter_slug', 'lang'];
}
