<?php

namespace FakerRestaurant\Provider\en_US;

class Restaurant extends \Faker\Provider\Base
{
    protected static $foodNames = [
        'Cheese Pizza', 'Hamburger', 'Cheeseburger', 'Bacon Burger', 'Bacon Cheeseburger',
        'Little Hamburger', 'Little Cheeseburger', 'Little Bacon Burger', 'Little Bacon Cheeseburger',
        'Veggie Sandwich', 'Cheese Veggie Sandwich', 'Grilled Cheese',
        'Cheese Dog', 'Bacon Dog', 'Bacon Cheese Dog', 'Pasta'
    ];
    
    protected static $beverageNames = [
        'Beer', 'Bud Light', 'Budweiser', 'Miller Lite',
        'Milk Shake', 'Tea', 'Sweet Tea', 'Coffee', 'Hot Tea',
        'Champagne', 'Wine', 'Lemonade', 'Coca-Cola', 'Diet Coke',
        'Water', 'Sprite', 'Orange Juice', 'Iced Coffee'
    ];
    
    protected static $foodDescription= [
        'Beer', 'Bud Light', 'Budweiser', 'Miller Lite',
        'Milk Shake', 'Tea', 'Sweet Tea', 'Coffee', 'Hot Tea',
        'Champagne', 'Wine', 'Lemonade', 'Coca-Cola', 'Diet Coke',
        'Water', 'Sprite', 'Orange Juice', 'Iced Coffee'
    ];

    protected static $dairyNames = [
        'Butter',
        'Egg',
        'Cheese',
        'Sour cream',
        'Mozzarella',
        'Yogurt',
        'Cream',
        'Milk',
        'Custard',
    ];

    protected static $vegetableNames = [
        'Onion',
        'Garlic',
        'Tomato',
        'Potato',
        'Carrot',
        'Bell Pepper',
        'Bell Basil',
        'Parsley',
        'Broccoli',
        'Corn',
        'Spinach',
        'Ginger',
        'Chili',
        'Celery',
        'Rosemary',
        'Cucumber',
        'Pickle',
        'Avocado',
        'Pumpkin',
        'Mint',
        'Eggplant',
        'Yam',
    ];

    protected static $fruitNames = [
        'Lemon',
        'Apple',
        'Banana',
        'Lime',
        'Strawberry',
        'Orange',
        'Pineapple',
        'Blueberry',
        'Raisin',
        'Coconut',
        'Grape',
        'Peach',
        'Raspberry',
        'Cranberry',
        'Mango',
        'Pear',
        'Blackberry',
        'Cherry',
        'Watermelon',
        'Kiwi',
        'Papaya',
        'Guava',
        'Lychee',
    ];

    protected static $meatNames = [
        'Chicken',
        'Bacon',
        'Sausage',
        'Beef',
        'Ham',
        'Hot dog',
        'Pork',
        'Turkey',
        'Chicken wing',
        'Chicken breast',
        'Lamb',
    ];

    protected static $sauceNames = [
        'Tomato sauce',
        'Tomato paste',
        'Mayonnaise sauce',
        'BBQ sauce',
        'Chili sauce',
        'Garlic sauce',
    ];

    /**
     * A random Food Name.
     * @return string
     */
    public function foodName()
    {
        return static::randomElement(static::$foodNames);
    }

    public function foodDescription($foodName)
    {
        $descriptions = [
            'Cheese Pizza' => 'A classic delight featuring a perfectly baked crust topped with a generous layer of melted mozzarella cheese and savory tomato sauce.',
            'Hamburger' => 'A timeless favorite, this dish showcases a succulent beef patty grilled to perfection, nestled between soft burger buns and adorned with fresh toppings.',
            'Cheeseburger' => 'Elevating the classic hamburger, this variation adds a luscious layer of melted cheese, creating a harmonious blend of flavors and textures.',
            'Bacon Burger' => 'A mouthwatering twist on the traditional burger, this indulgent option boasts a juicy beef patty adorned with crispy, savory bacon.',
            'Bacon Cheeseburger' => 'The ultimate carnivore\'s delight, this burger combines the richness of melted cheese with the smoky goodness of bacon, taking indulgence to a whole new level.',
            'Little Hamburger' => 'A downsized version of the classic hamburger, perfect for those with a smaller appetite but still craving the authentic taste of a delicious burger.',
            'Little Cheeseburger' => 'A petite rendition of the cheeseburger, providing a satisfying blend of flavors in a compact package, ideal for a quick and delightful bite.',
            'Little Bacon Burger' => 'Scaled down for convenience, this smaller bacon-infused burger still packs a flavorful punch with its juicy patty and crispy bacon.',
            'Little Bacon Cheeseburger' => 'A compact masterpiece that marries the rich flavors of melted cheese and savory bacon with a perfectly grilled mini beef patty.',
            'Veggie Sandwich' => 'A wholesome and plant-based option featuring a medley of fresh vegetables, served between slices of bread, offering a burst of flavors and textures.',
            'Cheese Veggie Sandwich' => 'A vegetarian delight combining the goodness of a variety of fresh vegetables with the richness of melted cheese, sandwiched between slices of bread.',
            'Grilled Cheese' => 'A comforting classic, this dish features golden-brown slices of bread embracing gooey, melted cheese for a simple yet satisfying experience.',
            'Cheese Dog' => 'A delicious twist on the classic hot dog, this version features a juicy sausage nestled in a bun and topped with melted cheese.',
            'Bacon Dog' => 'A flavorful hot dog variation, this dish adds the irresistible crunch of bacon to the classic sausage and bun combination.',
            'Bacon Cheese Dog' => 'Elevating the hot dog experience, this indulgent creation features the savory combination of crispy bacon and melted cheese atop a succulent sausage.',
            'Pasta' => 'A versatile and timeless dish, pasta is served al dente and paired with a variety of sauces, from classic marinara to creamy Alfredo, offering endless possibilities for a satisfying meal.',
        ];

        // Return the corresponding description or a default one if not found
        return $descriptions[$foodName] ?? 'Description not available for this food.';
    }

    /**
     * A random Beverage Name.
     * @return string
     */
    public function beverageName()
    {
        return static::randomElement(static::$beverageNames);
    }

    /**
     * A random Dairy Name.
     * @return string
     */
    public function dairyName()
    {
        return static::randomElement(static::$dairyNames);
    }

    /**
     * A random Vegetable Name.
     * @return string
     */
    public function vegetableName()
    {
        return static::randomElement(static::$vegetableNames);
    }

    /**
     * A random Fruit Name.
     * @return string
     */
    public function fruitName()
    {
        return static::randomElement(static::$fruitNames);
    }

    /**
     * A random Meat Name.
     * @return string
     */
    public function meatName()
    {
        return static::randomElement(static::$meatNames);
    }

    /**
     * A random Sauce Name.
     * @return string
     */
    public function sauceName()
    {
        return static::randomElement(static::$sauceNames);
    }
}
