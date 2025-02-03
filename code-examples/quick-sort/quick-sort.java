import java.util.ArrayList;

class Solution {
    public ArrayList<Integer> sortArray(ArrayList<Integer> nums) {
        if(nums.size() <= 1) {
            return nums;
        }

        ArrayList<Integer> low = new ArrayList<>();
        ArrayList<Integer> high = new ArrayList<>();
        int pivot = nums.getFirst();

        for(int i = 1; i < nums.size(); i++) {
            if(nums.get(i) < pivot) {
                low.add(nums.get(i));
            } else if(nums.get(i) > pivot){
                high.add(nums.get(i));
            }
        }

        ArrayList<Integer>result = new ArrayList<>(this.sortArray(low));
        result.add(pivot);
        result.addAll(this.sortArray(high));

        return result;
    }
}
