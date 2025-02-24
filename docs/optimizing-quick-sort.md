---
title: Optimizing Quick Sort
description: Optimizing Quick Sort
slug: /optimizing-quick-sort
sidebar_position: 4
---

import Tabs from '@theme/Tabs';
import TabItem from '@theme/TabItem';

### 朴素快排中内存爆炸的根源

- 递归时，每层几乎都要存储 n 个元素副本
- 基准选择不当，导致分区不平衡
- 每层递归都要创建 low/high/equal 三个数组

### 核心优化思路

- 随机选择基准的位置
- 模拟栈的运行方式，把递归改成迭代
- 原地分区，不另外创建数组

### 用“迭代+栈”来替代递归

- 递归是不断的调用自己实现不断的执行，直到满足某个条件。另外，系统会自动对当前迭代的状态进行保存。
  - 所以它有三个关键：不断执行+停止条件+自动状态保存。
- 对于不断执行，我们用循环+栈来代替。用数组模拟一个栈，不断的压入数据，然后循环执行弹出，直到栈为空。
- 对于停止条件，我们后续再考虑怎么写逻辑，但必须先明确它的主要目的是不再压入栈，逐步导致栈最终为空，进而打断执行。
- 对于状态，可理解为变量，也属于业务逻辑范畴，我们后续讨论到底要维护哪些状态。

有了这样一个基本逻辑，我们能描绘出这个迭代函数的大致轮廓：

```php
$stack = [1,2,3,4]          # 用数组模拟栈，里面放什么再讨论，这里模拟了4个数字
while(!empty($stack)) {   # 直到栈为空，不再循环
  array_pop($stack);      # 弹出栈顶元素，比如第一次弹出4
  // [停止条件]             # 它的作用是不再压入栈，具体内容后续讨论
  // [要做的事]             # 执行的算法逻辑，具体内容后续讨论
  array_push($stack,[5])    # 压入新的数据，后续讨论，它的作用是继续循环，这里模拟压入了数字5
}

```

自己压栈，自己弹栈，自己执行，自己判断停止条件，这就模拟了递归的过程。

### 算法逻辑 1：怎么分区

- 首先明确，我们写的还是快排算法，核心依然是分治。
- 有一个比基准值小的 `low` 区，比基准值大的 `high` 区，基准值在中间。
- 之前我们用递归来处理两个区，这次我们用迭代来处理。
- 所以还是不要忘掉基本思路：分区以分治。
- 之前的朴素快排法，我们把 low 和 high 分别递归，最后合并。相当于开辟了另外的执行空间，单独处理。
- 这次，我们不递归了，在原数组上直接处理，思路上有一些改变。
- 我们把数据想像成一条直线，如果我们要在直线上分两个区，其实只需要一个标记就够了。

```
  |-----------------------|——————————————————————————|
            low           |               high
                          |
                        这个点
```

- 所以这次的算法当中，最重要的就是这个点，它的作用是标记，标记的是 `low` 区域的最大下标。
- 我们给它取一个简单的名字，叫 `lowMax`。
- 而其他位置的名字，我们也形象的去命名一下：

```
  |-----------------------|——————————————————————————|
  |          low          |            high          |
  |                       |                          |
lowMin                lowMax                       highMax
```

- 在这个模型的基础上，我们的基准数 `pivot` 就是在 `lowMax+1` 的位置上。
- 我们这次的核心思路，就是让 `lowMax` 走起来，它太重要了，因为它能标识两个区域，还能标识基准值的位置。
- 我们想像一下，初始状态，`lowMax` 应该是最左边对吧，因为小于的区域还没有元素。
- 随后我们开始逐个比较，一旦比较出比基准小的数，我们就把 `lowMax + 1`，相当于为 `low` 区域扩容了。
- 然后做一个交换操作，把那个数与 `lowMax` 交换，这样就把它元素放到了 `low` 区域。
- 如果比基准大怎么办？不用管，我们只需要管理 `low` 区域的数，而剩下的自然属于 `high` 区域。
- 所以你能想像到，`lowMax` 会不断的右移。

**_这种快排思路被称为 Lomuto（洛穆托）分区法_**

### 算法逻辑 2：怎么随机选择基准

- 之前的朴素快排中，我们把第一个元素作为基准值。
- 这里有一个问题，如果数据是有序的，那每次基准值都是最大或最小值，时间复杂度就退化了。
- 所以我们考虑随机选一个位置做基准值，这样可以避免最坏情况。
- 代码非常简单。

```
$randomIndex = rand($lowMin, $highMax);
```

- 再做一件看起来很怪异的事，把它与 `highMax` 交换。

```
$randomIndex = rand($lowMin, $highMax);
$arr[$randomIndex] <-> $arr[$highMax];
```

- 把它放到最后，主要原因是分区时数组要遍历，遍历时如果这个基准值在随机位置，有点不方便我们找到它和略过它。
- 所以我们临时的，先把它放到最后，但这是临时的。
- 想着，在我们排序好以后，再把它交换回来。
- 交换到哪呢，往上看，它的合理位置应该在 `lowMax+1` 的位置上。
- 至此，我们可以写代码了。

### 代码示例

<Tabs className="lang-tabs" groupId="lang" queryString>
  <TabItem value="php" label="PHP">

```php file=../code-examples/quick-sort-lomuto/quick-sort-lomuto.php

```

  </TabItem>
</Tabs>

### 差异对比

#### 随机化基准选择

- 原代码中，总是使用第一个元素作为基准，极端情况下，时间复杂度退化为 O(n²)，如 [1,2,3,4,5,6]。
- 优化后，每次随机选择一个元素作为基准，避免最坏时间复杂度。

#### 递归与迭代

- 原代码中，使用递归，系统会自动维护一个栈，用于存储调用的上下文（参数变量返回地址等）。
- 优化后，通过数组模拟栈，手动维护了两个整数 `low` 和 `high`，节省内存开销。

#### 额外数组与原地分区

- 原代码中，每次递归都会创建三个数组，然后复制数据、拼接数据。
- 原地分区（In-place Partition）：内存消耗不会随着数据量增加而增加，空间复杂度为 O(1)。
- 优化后，所有交换操作都直接基于原数组，只额外存储了位置信息，不会创建额外的数组，也避免了复制和拼接。

### 递归与迭代

#### 递归

- 递归每次递归系统会自动将当前状态压入栈，内存管理由系统自动完成。
- 递归代码简洁，符合人类思维，直观，可读性强。
- 内存不可控，递归深度过深会导致栈溢出。
- 属于懒人分治。

#### 迭代

- 迭代是利用循环和数据结构，显式地控制流程和维护状态。
- 迭代代码相对复杂，需要手动维护状态，可读性差。
- 内存可控，适合处理大数据。
- 属于勤人分治。

### 递归转迭代

大多数递归算法都可以转换为迭代。

- 用栈或队列模拟递归调用过程，存储待处理的子任务。
- 用循环替代递归，不断取出栈中的任务，直到栈为空。
- 对于递归参数，手动定义变量维护状态。
