<?php

namespace App\Infrastructure\Dto\Buienradar;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

class VerwachtingMeerdaags
{
    /**
     * @var string
     * @Type("string")
     */
    public $tekst_middellang;

    /**
     * @var string
     * @Type("string")
     */
    public $tekst_lang;

    /**
     * @var VerwachtingDag
     * @Type("App\Infrastructure\Dto\Buienradar\VerwachtingDag")
     * @SerializedName("dag-plus1")
     */
    public $dagPlus1;

    /**
     * @var VerwachtingDag
     * @Type("App\Infrastructure\Dto\Buienradar\VerwachtingDag")
     * @SerializedName("dag-plus2")
     */
    public $dagPlus2;

    /**
     * @var VerwachtingDag
     * @Type("App\Infrastructure\Dto\Buienradar\VerwachtingDag")
     * @SerializedName("dag-plus3")
     */
    public $dagPlus3;

    /**
     * @var VerwachtingDag
     * @Type("App\Infrastructure\Dto\Buienradar\VerwachtingDag")
     * @SerializedName("dag-plus4")
     */
    public $dagPlus4;

    /**
     * @var VerwachtingDag
     * @Type("App\Infrastructure\Dto\Buienradar\VerwachtingDag")
     * @SerializedName("dag-plus5")
     */
    public $dagPlus5;
}
