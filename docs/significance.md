---
title: Significance
description: Significance
slug: /significance
sidebar_position: 1
---

# 算法的意义

- 一般普遍通用的业务逻辑中，不涉及**底层**算法。
- 算法是区分“**功能**实现”与“**高效**实现”的关键，尤其是在性能优化时。

## 对开发者的意义

1. 理解所使用工具的本质

- MySQL 索引，B+树的本质就是算法。
- B+树支持多层级节点快速范围查询，时间复杂度为 O(logN)。
- 若未命中索引，导致全表扫描，时间复杂度为 O(N)。

2. 从功能实现到高效实现

- 使用多种数据结构优化性能，例如 Redis 的 Bitmap、HyperLogLog
- 利用迭代+栈或队列优化递归实现，避免栈溢出
- 根据业务特点，有效使用缓存机制，如 LRU、LFU

## 算法不是“知识”，而是“思维”

- 在代码层面预判性能瓶颈
- 合理选择第三方库
- 写出更易维护的代码
- 应对高并发或大数据处理时更有思路
