<?php
namespace App\Domain\Shift;

use App\Data\Mapper\ShiftMapper;
use App\Data\Paginate;
use Aura\Payload\Payload;
use Spark\Adr\DomainInterface;

class GetList implements DomainInterface
{

    protected $shifts;
    /**
     * @var ShiftMapper
     */
    protected $mapper;

    public function __construct(ShiftMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function __invoke(array $input)
    {
        $input += [
            'user_id' => false,
        ] + Paginate::$defaultOptions;

        $payload = new Payload();
        $payload->setStatus(Payload::FOUND);

        $output = [];

        $options = array_filter([
            'user_id' => $input['user_id'],
            'limit'   => $input['limit'], // TODO: Simplify this so I don't need to pass the vars somehow.
            'page'    => $input['page'],
        ]);

        list($shifts, $paginate) = $this->mapper->getShifts($options);

        $output['meta']['paginate'] = $paginate->getMeta();

        $output['shifts'] = $shifts;

        $payload->setOutput($output);

        return $payload;
    }
}