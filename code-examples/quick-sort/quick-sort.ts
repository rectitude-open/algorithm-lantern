function sortArray(nums: number[]): number[] {
  if (nums.length <= 1) {
    return nums;
  }

  let low = [];
  let high = [];

  const pivot = nums[0];
  for (let index = 1; index < nums.length; index++) {
    if (nums[index] < pivot) {
      low.push(nums[index]);
    } else if (nums[index] > pivot) {
      high.push(nums[index]);
    }
  }

  return [...sortArray(low), pivot, ...sortArray(high)];
}
