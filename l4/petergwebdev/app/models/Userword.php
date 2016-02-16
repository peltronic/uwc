<?php 

class Userword extends BaseModel{

    public static $rules = [
        // 'title' => 'required'
    ];

    protected $fillable = ['word','translation','user_id','baseword_id'];

    public function __construct()
    {
        parent::__construct();
    }


    public static function doStore($attrs)
    {
        $userword = \DB::transaction(function() use($attrs) {
            $baseword = \Baseword::where('word', '=', $attrs['word'])->first();

            if (empty($baseword)) {
                $baseword = \Baseword::doStore($attrs);
            }
    
            // create the Userword
            $attrs['baseword_id'] = $baseword->id;
            $userword = new \Userword;
            $userword->fill($attrs);
            $userword->save();

            return $userword;
        });

        return $userword;
    }

    public static function doUpdateByPKID($pkid,$attrs,$userID)
    {
        $userword = \DB::transaction(function() use($attrs,$pkid,$userID) {
            $userword = \Userword::where('user_id','=',$userID)->where('id','=',$pkid)->firstOrFail();
            $userword->fill($attrs);
            $userword->save();
            return $userword;
        });
        return $userword;
    }

    public static function doUpdateByWord($word,$attrs,$userID)
    {
        $userword = \DB::transaction(function() use($attrs,$word,$userID) {
            $userword = \Userword::where('user_id','=',$user->id)->where('word','=',$word)->firstOrFail(); // %FIXME: use slug (?)
            $userword->fill($attrs);
            $userword->save();
            return $userword;
        });
        return $userword;
    }

    // ---

    public function baseword()
    {
        return $this->belongsTo('Baseword');
    }

}
