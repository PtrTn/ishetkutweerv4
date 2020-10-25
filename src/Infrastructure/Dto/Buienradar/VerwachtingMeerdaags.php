<?php

declare(strict_types=1);

namespace App\Infrastructure\Dto\Buienradar;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

class VerwachtingMeerdaags
{
    /**
     * @var mixed
     * @Type("string")
     */
    public $tekst_middellang;

    /**
     * @var mixed
     * @Type("string")
     */
    public $tekst_lang;

    /**
     * @Type("App\Infrastructure\Dto\Buienradar\VerwachtingDag")
     * @SerializedName("dag-plus1")
     */
    public VerwachtingDag $dagPlus1;

    /**
     * @Type("App\Infrastructure\Dto\Buienradar\VerwachtingDag")
     * @SerializedName("dag-plus2")
     */
    public VerwachtingDag $dagPlus2;

    /**
     * @Type("App\Infrastructure\Dto\Buienradar\VerwachtingDag")
     * @SerializedName("dag-plus3")
     */
    public VerwachtingDag $dagPlus3;

    /**
     * @Type("App\Infrastructure\Dto\Buienradar\VerwachtingDag")
     * @SerializedName("dag-plus4")
     */
    public VerwachtingDag $dagPlus4;

    /**
     * @Type("App\Infrastructure\Dto\Buienradar\VerwachtingDag")
     * @SerializedName("dag-plus5")
     */
    public VerwachtingDag $dagPlus5;
}
