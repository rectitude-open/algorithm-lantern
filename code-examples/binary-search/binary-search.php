class Solution {
    function search($nums, $target) {
        $left = 0;
        $right = count($nums) - 1;

        while($left <= $right) {
            $mid = floor(($left + $right) / 2);

            if($target > $nums[$mid]) {
                $left = $mid + 1;
            } elseif ($target < $nums[$mid]) {
                $right = $mid - 1;
            } else {
                return $mid;
            }
        }

        return -1;
    }
}
