---
title: Quick Sort
description: Quick Sort
slug: /quick-sort
sidebar_position: 2
---

import Tabs from '@theme/Tabs';
import TabItem from '@theme/TabItem';

### 核心思维

- 分而治之，逐个击破；巧妙分区，递归实现。
- 设置一个基准值，设置两个区域，一个放比基准值小的，一个放比基准值大的。
- 两个区域内部竞赛，也就是分别递归，直到无值可比，最终合并结果。

### 依赖

- 明确停止条件：如果要处理的数据数量 &le; 1，那就直接返回，不用排了。

### 步骤

1. 先写停止条件：如果只有一个元素，直接返回。`if len(arr) <= 1 : return arr`
2. 设立两个区域：小于基准值的区域 `low`，大于基准值的区域 `high`。
3. 选择一个基准值，一般选择第一个元素 `pivot = arr[0]`。
4. 循环要处理的数组，逐个比较元素与基准值，分别放入 `low` 或 `high` 区域。
5. 递归处理 `low` 和 `high` 区域。
6. 最终要返回的数据顺序是：`递归(low)的结果 + 基准值 + 递归(high)的结果`。

### 复杂度

- 平均时间复杂度：O(n log n)
  - 每次比较，问题规模约减半，相当于对数据量 n 取对数 log n，这也是后续递归的深度。
  - 在每一个区域内部，每个元素至少有一次比较，所以是 n \* log n。
- 最坏时间复杂度：O(n^2)
  - 如果每次基准值都是最大或最小值，那问题规模不减半，而是每次只减少一个元素。
  - 那递归深度就是 n，每个区域比较次数也是 n，所以是 n \* n。
- 空间复杂度：O(log n)
  - 递归深度是 log n，所以需要 log n 的栈空间。

### 实际应用

- PHP 的内置 sort 函数在快排的基础上做了优化，对小数据量使用插入排序，效率更高。

### 应用方向

- 分治思想：将大问题拆解为小问题

### 代码示例

<Tabs className="lang-tabs" groupId="lang" queryString>
  <TabItem value="php" label="PHP">

```php file=../code-examples/quick-sort/quick-sort.php

```

  </TabItem>

  <TabItem value="java" label="Java">

```java file=../code-examples/quick-sort/quick-sort.java

```

  </TabItem>
  <TabItem value="ts" label="Typescript">

```ts file=../code-examples/quick-sort/quick-sort.ts

```

  </TabItem>

</Tabs>
### 代码示例（支持重复值）

<Tabs className="lang-tabs" groupId="lang" queryString>
  <TabItem value="php" label="PHP">

```php file=../code-examples/quick-sort/quick-sort-with-duplicates.php

```

  </TabItem>
  <TabItem value="java" label="Java">

```java file=../code-examples/quick-sort/quick-sort-with-duplicates.java

```

  </TabItem>
  <TabItem value="ts" label="Typescript">

```ts file=../code-examples/quick-sort/quick-sort-with-duplicates.ts

```

  </TabItem>

</Tabs>
