function sortArray(nums: number[]): number[] {
  if (nums.length <= 1) {
    return nums;
  }

  let low = [];
  let high = [];
  let equal = [];

  const pivot = nums[0];

  nums.forEach((num) => {
    if (num < pivot) {
      low.push(num);
    } else if (num > pivot) {
      high.push(num);
    } else {
      equal.push(num);
    }
  });

  return [...sortArray(low), ...equal, ...sortArray(high)];
}
