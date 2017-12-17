14. Организаци последовательного кода
==============

### Контрольный список

+ способствует ли код выявлению зависимостей между выражениями? 
+ способствуют ли имена методов выявлению зависимостей? 
+ способствуют ли параметры методов выявлению зависимостей? 
+ описывают ли комментарии такие зависимости, которые иначе не будут явными? 
+ используются ли вспомогательные переменные для проверки последовательных действий в критических частях кода? 
+ возможно ли прочтение кода сверху вниз? 
+ сгруппированы ли вместе взаимосвязанные выражения? 
+ перенесены ли относительно независимые группы выражений в отдельные методы? 

### Ключевые моменты 

+ главный принцип организации последовательного кода Ч упорядочение зависимостей. 
+ «ависимости должны быть сделаны явными с помощью хороших имен методов, списков параметров, комментариев и Ч если последовательность кода достаточно критична Ч с помощью вспомогательных переменных. 
+ если порядковые зависимости в коде отсутствуют, старайтесь размещать взаимосвязанные выражения как можно ближе друг к другу. 