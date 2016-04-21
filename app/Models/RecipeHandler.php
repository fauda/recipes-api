<?php

namespace App\Models;

use App\Http\Requests\ParsedRequest;
use League\Csv\Reader;

class RecipeHandler
{
    /**
     * @var Reader
     */
    protected $csvReader;

    /**
     * RecipeFactory constructor.
     * @param Reader $csvReader
     */
    public function __construct(Reader $csvReader)
    {
        $this->csvReader = $csvReader;
    }

    /**
     * Fetch a recipe by id
     * @param int $id
     * @return Recipe
     */
    public function fetchById(int $id)
    {
        return $this->createRecipeObject(
            $this->csvReader->fetchOne($id - 1)
        );
    }

    /**
     * Fetch all recipe objects
     * @param ParsedRequest $parsedRequest
     * @return array
     */
    public function fetchAll(ParsedRequest $parsedRequest)
    {
        $rows = $this->csvReader->fetchAll();
        $allowedRows = [];
        $index = 0;

        while (count($allowedRows) < $parsedRequest->getMaxResults()) {
            if (empty($rows[$index])) break;

            if ($index > $parsedRequest->getAfter() - 1) {
                $allowedRows[] = $rows[$index];
            }

            $index++;
        }

        return $this->createRecipeObjectList($allowedRows);
    }

    /**
     * Create a recipe object list
     * @param array $rows
     * @return array
     */
    public function createRecipeObjectList(array $rows) : array
    {
        $list = [];

        foreach ($rows as $row) {
            $list[] = $this->createRecipeObject($row);
        }

        return $list;
    }

    /**
     * Create a Recipe object with a csv row
     * @param array $row
     * @return Recipe
     */
    public function createRecipeObject(array $row) : Recipe
    {
        $recipe = new Recipe();

        $this->hydrateFromRow($recipe, $row);

        return $recipe;
    }

    /**
     * Hydrate a Recipe object with a csv row
     * @param Recipe $recipe
     * @param $row
     */
    public function hydrateFromRow(Recipe $recipe, $row)
    {
        $recipe
            ->setId($row[0])
            ->setCreatedAt($row[1])
            ->setUpdatedAt($row[2])
            ->setBoxType($row[3])
            ->setTitle($row[4])
            ->setSlug($row[5])
            ->setShortTitle($row[6])
            ->setMarketingDescription($row[7])
            ->setCaloriesKcal($row[8])
            ->setProteinGrams($row[9])
            ->setFatGrams($row[10])
            ->setCarbsGrams($row[11])
            ->setBulletpoint1($row[12])
            ->setBulletpoint2($row[13])
            ->setBulletpoint3($row[14])
            ->setRecipeDietTypeId($row[15])
            ->setSeason($row[16])
            ->setBase($row[17])
            ->setProteinSource($row[18])
            ->setPreparationTimeMinutes($row[19])
            ->setShelfLifeDays($row[20])
            ->setEquipmentNeeded($row[21])
            ->setOriginCountry($row[22])
            ->setRecipeCuisine($row[23])
            ->setInYourBox($row[24])
            ->setGoustoReference($row[25])
            ->setRatingTotal($row[26])
            ->setRatingCount($row[27]);
    }

    /**
     * Save a new recipe to the csv
     * @param Recipe $recipe
     */
    public function save(Recipe $recipe)
    {
        $rows = $this->csvReader->fetchAll();
        $lastRow = end($rows);
        $lastId = $lastRow[0];

        $recipe
            ->setId($lastId + 1)
            ->setCreatedAt(date('d/m/Y G:i:s'))
            ->setUpdatedAt(date('d/m/Y G:i:s'));

        $this->csvReader->newWriter('a')->insertOne($this->getArrayFromObject($recipe));
    }

    /**
     * Update a recipe in the csv
     * @param Recipe $recipe
     */
    public function update(Recipe $recipe)
    {
        $rowIndex = $recipe->getId() - 1;

        $rows = $this->csvReader->fetchAll();

        $recipe
            ->setCreatedAt($rows[$rowIndex][1])
            ->setUpdatedAt(date('d/m/Y G:i:s'));

        $rows[$rowIndex] = $this->getArrayFromObject($recipe);

        $this->csvReader->newWriter('w')->insertAll($rows);
    }

    /**
     * @param Recipe $recipe
     * @return array
     */
    public function getArrayFromObject(Recipe $recipe)
    {
        return [
            $recipe->getId(),
            $recipe->getCreatedAt(),
            $recipe->getUpdatedAt(),
            $recipe->getBoxType(),
            $recipe->getTitle(),
            $recipe->getSlug(),
            $recipe->getShortTitle(),
            $recipe->getMarketingDescription(),
            $recipe->getCaloriesKcal(),
            $recipe->getProteinGrams(),
            $recipe->getFatGrams(),
            $recipe->getCarbsGrams(),
            $recipe->getBulletpoint1(),
            $recipe->getBulletpoint2(),
            $recipe->getBulletpoint3(),
            $recipe->getRecipeDietTypeId(),
            $recipe->getSeason(),
            $recipe->getBase(),
            $recipe->getProteinSource(),
            $recipe->getPreparationTimeMinutes(),
            $recipe->getShelfLifeDays(),
            $recipe->getEquipmentNeeded(),
            $recipe->getOriginCountry(),
            $recipe->getRecipeCuisine(),
            $recipe->getInYourBox(),
            $recipe->getGoustoReference(),
            $recipe->getRatingTotal(),
            $recipe->getRatingCount(),
        ];
    }
}