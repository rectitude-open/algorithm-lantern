class Solution
{
    public function sortArray($nums)
    {
        if (count($nums) <= 1) {
            return $nums;
        }

        $low = $high = $equal = [];
        $pivot = $nums[0];

        foreach ($nums as $num) {
            if ($num > $pivot) {
                $high[] = $num;
            } elseif ($num < $pivot) {
                $low[] = $num;
            } else {
                $equal[] = $num;
            }
        }

        return [...$this->sortArray($low), ...$equal, ...$this->sortArray($high)];
    }
}
