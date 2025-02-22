class Solution
{
    public function sortArray($nums)
    {
        $this->sortIterative($nums);
        return $nums;
    }

    private function sortIterative(&$nums)
    {
        $stack = [[0, count($nums) - 1]];
        while (!empty($stack)) {
            [$lowMin, $highMax] = array_pop($stack);

            if ($lowMin >= $highMax) {
                continue;
            }

            $pivotIndex = $this->partition($nums, $lowMin, $highMax);

            array_push($stack, [$pivotIndex + 1, $highMax]);
            array_push($stack, [$lowMin ,$pivotIndex - 1]);
        }
    }

    private function partition(&$nums, $lowMin, $highMax)
    {
        $randomIndex = rand($lowMin, $highMax);
        [$nums[$randomIndex], $nums[$highMax]] = [$nums[$highMax],$nums[$randomIndex]];

        $pivot = $nums[$highMax];
        $lowMax = $lowMin - 1;

        for ($i = $lowMin; $i < $highMax; $i++) {
            if ($nums[$i] < $pivot) {
                $lowMax++;
                [$nums[$i], $nums[$lowMax]] = [$nums[$lowMax],$nums[$i]];
            }
        }

        [$nums[$lowMax + 1],$nums[$highMax]] = [$nums[$highMax],$nums[$lowMax + 1]];

        return $lowMax + 1;
    }
}
