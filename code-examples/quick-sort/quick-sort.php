class Solution {
    function sortArray($nums) {
        if(count($nums) <= 1) {
            return $nums;
        }

        $low = $high = [];
        $pivot = $nums[0];
        for ($i = 1; $i < count($nums); $i++) {
            if($nums[$i] > $pivot) {
                $high[] = $nums[$i];
            } elseif($nums[$i] < $pivot) {
                $low[] = $nums[$i];
            }
        }
        
        return [...$this->sortArray($low), $pivot, ...$this->sortArray($high)];
    }
}
