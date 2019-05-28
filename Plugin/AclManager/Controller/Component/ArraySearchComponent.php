<?php
namespace \

App::uses('Component', 'Controller');
class ArraySearchComponent extends Component
{
   /**
    * Search in array a especific value and return your last level parent (Case Insensitive)
    * @param  [string] $needle   [the term of you are looking for]
    * @param  [array] $haystack [array target]
    * @return [string] $current_key    [the key position of array]
    */
    public function insensitiveSearch($needle, $haystack)
    {
        foreach ($haystack as $key => $value) {
            $current_key=$key;
            if (@strtolower((string)$needle)==@strtolower((string)$value)
                or strtolower((string)$needle)==strtolower((string)$key)
                or (is_array($value) && $this->insensitiveSearch($needle, $value) !== false)) {
                return $current_key;
            }
        }
        return false;
    }
    /**
     * Search in array a especific value and return your last level parent (Case Sensitive)
     * @param  [string] $needle   [the term of you are looking for]
     * @param  [array] $haystack [array target]
     * @return [string] $current_key    [the key position of array]
     */
    public function sensitiveSearch($needle, $haystack)
    {
        foreach ($haystack as $key => $value) {
            $current_key=$key;
            if ($needle===$value
                or $needle===$key
                or (is_array($value)
                    && $this->sensitiveSearch($needle, $value) !== false)) {
                    return $current_key;
            }
        }
        return false;
    }

    /**
     * Verify if a value exists in a especific array (Case Insensitive)
     * @param  [string] $needle   [the term of you are looking for]
     * @param  [array] $haystack [array target]
     * @return [bool] true/false
     */
    public function insensitiveCheck($needle, $haystack)
    {
        foreach ($haystack as $key => $value) {
            $current_key=$key;
            if (@strtolower((string)$needle)==@strtolower($value['actionPath'])
                or strtolower((string)$needle)==strtolower((string)$key)
                or (is_array($value) && $this->insensitiveCheck($needle, $value) !== false)
            ) {
                return true;
            }
        }
        return false;
    }

     /**
      * Verify if a value exists in a especific array (Case Sensitive)
      * @param  [string] $needle   [the term of you are looking for]
      * @param  [array] $haystack [array target]
      * @return [bool] true/false
      */
    public function sensitiveCheck($needle, $haystack)
    {
        foreach ($haystack as $key => $value) {
            $current_key=$key;
            if ($needle===$value
                or $needle===$key
                or(is_array($value) && $this->sensitiveCheck($needle, $value) !== false)) {
                return $true;
            }
        }
        return false;
    }
}
