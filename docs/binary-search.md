---
title: Binary Search
description: Binary Search
slug: /binary-search
sidebar_position: 2
---

import Tabs from '@theme/Tabs';
import TabItem from '@theme/TabItem';

### 核心思维

- 通过一定决策规则，快速缩小问题的规模，直至找到问题的解。
- 用于在数据集合中快速查找到特定元素。

### 依赖

- 数据有序：由于使用比较的方法，所以需要数据有序。
- 明确停止条件：避免死循环

### 步骤

1. 所有数据由小到大有序排列，形成一条线。
2. 一条线上定义三个点：左`left`、中`mid`、右`right`，记录位置（下标）。
3. 中=（左+右）/2，向下取整。`mid = (left + right) / 2`
4. 左右为边界，用中间值与要找的目标值`value`比较。
5. 如果目标大于中间，则目标在肯定在右边，移动左=中+1。`left = mid + 1`
6. 反之，右=中-1。`right = mid - 1`
7. 如此循环，直到目标值等于中间值，返回中间值的位置。`return mid`
8. 避免死循环：明确循环条件：左位置 &le; 右位置，否则就是没找到，退出。`return -1`

### 实际应用

- 数据库分页优化
  - `LIMIT $offset, $size` 在大数据量时，性能低下，因需要扫描 $offset 条数据。
  - 通过二分查找思维，使用 `WHERE id > $last_id LIMIT $size`，直接跳过无用行，性能更高。

### 应用方向

- 性能优化：用 O(log n)替代 O(n)
- 数据处理：快速查找或统计
- Bug 排查：快速定位

### 代码示例

<Tabs className="lang-tabs" groupId="lang" queryString>
  <TabItem value="php" label="PHP">

```php file=../code-examples/binary-search/binary-search.php

```

  </TabItem>
  <TabItem value="java" label="Java">

```java file=../code-examples/binary-search/binary-search.java

```

  </TabItem>
  <TabItem value="ts" label="TypeScript">

```ts file=../code-examples/binary-search/binary-search.ts

```

  </TabItem>
</Tabs>
