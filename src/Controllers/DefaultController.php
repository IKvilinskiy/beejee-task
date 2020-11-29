<?php


namespace App\Controllers;


use App\Models\Task;
use App\Services\ServiceContainer;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Class DefaultController
 * @package App\Controllers
 */
class DefaultController extends AbstractController
{
    public function actionIndex()
    {
        $sortFields = [
            'name' => 'Имя',
            'email' => 'E-Mail',
            'isDone' => 'Статусу',
        ];

        $sortTypes = [
            'desc' => 'Убыванию',
            'asc' => 'Возростанию'
        ];

        $dql = 'SELECT t FROM App\Models\Task t';

        $getData = $this->escapeRequestData($_GET);

        if (isset($getData['sortBy']) && in_array($getData['sortBy'], array_keys($sortFields))) {
            $dql .= ' ORDER BY t.' . $getData['sortBy'];

            if (isset($getData['sortOrder'])) {
                $dql .= $getData['sortOrder'] == 'desc' ? ' DESC' : ' ASC';
            }
        }

        $paginationStep = 3;
        $page = $getData['page'] ?? 1;
        $offset = $page > 1 ? $paginationStep * ($page - 1) : 0;

        $em = ServiceContainer::getInstance()->getEntityManager();

        $query = $em->createQuery($dql)
            ->setFirstResult($offset)
            ->setMaxResults($paginationStep);

        $paginator = new Paginator($query);

        $this->render('default/index.php', [
            'pagesCount' => ceil(count($paginator) / $paginationStep),
            'models' => $paginator,
            'page' => $page,
            'isGuest' => $this->userIsGuest(),
            'sortFields' => $sortFields,
            'sortTypes' => $sortTypes,
            'currentSortField' => $getData['sortBy'] ?? null,
            'currentSortOrder' => $getData['sortOrder'] ?? 'asc',
        ]);
    }

    public function actionCreate()
    {
        $model = new Task();

        $this->title = 'Создать';

        $this->processForm($model);
    }

    public function actionUpdate()
    {
        if ($this->userIsGuest()) {
            header(
                'Location: '
                . ServiceContainer::getInstance()
                    ->getUrlBuilder()
                    ->setController('auth')
                    ->getUrl()
            );
        }

        if (!isset($_GET['id']))
            throw new \Exception('Page not found', 404);

        $repository = ServiceContainer::getInstance()
            ->getEntityManager()
            ->getRepository(Task::class);

        /** @var Task $model */
        $model = $repository->find($_GET['id']);

        if (!$model) throw new \Exception('Не верный ID', 404);

        $this->title = 'Обновить';
        $this->processForm($model, false);
    }

    private function processForm(Task $model, bool $flushAfterSave = true)
    {
        $alerts = [];

        if (!empty($_POST)) {
            $formData = $this->escapeRequestData($_POST);

            $model
                ->setName($formData['name'] ?? null)
                ->setEmail($formData['email'] ?? null)
                ->setText($formData['text'] ?? null)
            ;

            if (!$this->userIsGuest()) {
                $model->setIsDone(isset($formData['isDone']));
            }

            if ($model->validate()) {

                $em = ServiceContainer::getInstance()->getEntityManager();

                $em->persist($model);
                $em->flush();

                if ($flushAfterSave) $model = new $model;

                $alerts[] = [
                    'type' => 'success',
                    'message' => 'Сохранено!',
                ];
            } else {
                foreach ($model->getErrors() as $error) {
                    $alerts[] = [
                        'type' => 'danger',
                        'message' => $error,
                    ];
                }
            }
        }

        $this->render('default/form.php', [
            'model' => $model,
            'alerts' => $alerts,
            'isGuest' => $this->userIsGuest(),
        ]);
    }
}
