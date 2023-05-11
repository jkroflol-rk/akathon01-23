def Average(arr):
    n = len(arr)
    total = 0
    for i in range(n):
        total += arr[i]
    avg = total / n
    return avg

test = [1, 2, 3, 4, 5]
result = Average(test)
print("The average of", test, "is", result)

if result >= 10:
    print("Double digits")
else:
    print("Single digits")

