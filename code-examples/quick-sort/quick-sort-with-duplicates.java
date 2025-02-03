import java.util.ArrayList;

class Solution {
    public ArrayList<Integer> sortArray(ArrayList<Integer> nums) {
        if(nums.size() <= 1) {
            return nums;
        }

        ArrayList<Integer> low = new ArrayList<>();
        ArrayList<Integer> high = new ArrayList<>();
        ArrayList<Integer> equal = new ArrayList<>();
        int pivot = nums.getFirst();

        for (Integer integer : nums) {
            if (integer < pivot) {
                low.add(integer);
            } else if (integer > pivot) {
                high.add(integer);
            } else {
                equal.add(integer);
            }
        }

        ArrayList<Integer>result = new ArrayList<>(this.sortArray(low));
        result.addAll(equal);
        result.addAll(this.sortArray(high));

        return result;
    }
}
