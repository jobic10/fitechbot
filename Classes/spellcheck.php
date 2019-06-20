<?php 



/**

SpellCheck 1.0.0

Copyright 2015

Developed by:
Richard mcfriend
richardmcfriend@live.com

for

www.oshody.com

=================================================================================

SpellCheck is a class that hopes to provide spellcheck and 
word correction in sentences.

SpellCheck goes to a string, finds errors and attempts to predict the writers
original intention.

SpellCheck employs a minified set of english words (94021 in precise 
which can easily be extended) in attempting to correct users error based 
on the principle of least possible error (It assumes the error is not too great).

SpellCheck can be used to create a Google-like "Did you mean" features in your
websites and much more.

=================================================================================


Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. 

*/



/*

//USAGE EXAMPLE
//=================
$m = "wrog spellng";
echo "You typed: $m<br />";
$h = new SpellCheck($m);
$h->prepend("Did you mean: ");
echo $h->corrected();
echo $h->error();
foreach($h->spell_errors() as $m){
    echo "<br />You seem to have mistyped &quot;".$m[1]."&quot; as &quot;".$m[0]."&quot;<br />";
}

*/


class SpellCheck {

    
    public $VERSION = "1.0.0";
    
    // input misspelled word
	private $input = null;
                      
	private $shortest = -1;
                      
	private $final_word = null;
                                  
    private $error = null;    
    
    // a text to display before displaying a corrected text.
    // it is not used if the text is not wrong...
    private $prepend = null;
    
    // holds an array of spell errors occuring in users input and 
    // their corrections.
    protected $input_errors = array();
                                  
    // global check if spellerrors exist.
    private $haserrors = false;
	
	public function __construct($string = null){
        if(is_string($string) && !empty($string)){
            $this->input = $string;
            $this->correct();
        } else {
            $this->error = "Please supply a proper word.";
        }
    }
    
    protected function correct(){
        
        if(empty($this->input)){
            $this->error = "There is nothing to correct";
            return;
        }
                                  
	    $input_break = preg_split("/[^a-zA-Z0-9\-_]/", $this->input);
                      
        foreach($input_break  as $break){
    
            $closest = "";

            // loop through words to find the closest
            foreach ($this->englishWords as $word) {

                // calculate the distance between the input word,
                // and the current word
                $lev = levenshtein(strtolower($break), strtolower($word));
    
                // check for an exact match
                if ($lev == 0) {

                    // closest word is this one (exact match)
                    $closest = $break;
                    $this->shortest = -1;

                    // break out of the loop; we've found an exact match
                    break;
                }
 
                // if this distance is less than the next found shortest
                // distance, OR if a next shortest word has not yet been found
                if ($lev <= $this->shortest || $this->shortest < 0) {
                    // set the closest match, and shortest distance
                    $closest  = $word;
                    
                    // Keeping the upper cases...
                    if(preg_match("/[A-Z]/", $break)){
                        if(preg_match("/[a-z]/", $break))
                            $closest = ucwords($closest);
                        else 
                            $closest = strtoupper($closest);
                        
                    }
                    $this->shortest = $lev;
                }
            }
            
            if($this->shortest > -1){
                array_push($this->input_errors, array($break,$closest));
                if($this->haserrors!=true)$this->haserrors = true;
            }
 
            $this->final_word .= $closest." ";
    
        }
                      
        $this->final_word = substr($this->final_word, 0, strlen($this->final_word) - 1);

    }
                                  
    function is_correct(){
        
        if(empty($this->input)){
            $this->error = "There is nothing to verify";
            return;
        }
        
        if($this->shortest > -1)
                return true;
        else
            return false;
    }
                                  
    function prepend($string){
        
        $this->prepend = $string;
        
    }
                                  
    function corrected(){
        if(!empty($this->input)){
            return ($this->haserrors == true?$this->prepend:"").$this->final_word;
        } else {
            return $this->input;
        }
    }
                                  
    function spell_errors(){
        return $this->input_errors;
    }
                                  
    function error(){
        
        return $this->error;
        
    }
                                  
}
                                  
                                  


?> 