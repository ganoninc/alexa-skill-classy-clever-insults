<?php
use MaxBeckers\AmazonAlexa\Helper\ResponseHelper;
use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\Standard\IntentRequest;
use MaxBeckers\AmazonAlexa\RequestHandler\AbstractRequestHandler;
use MaxBeckers\AmazonAlexa\Response\Response;
/**
 * Handles classy and clever insults alexa intent requests
 *
 * @author Romain Giovanetti <rgiovanetti@outlook.com>
 */
class ClassyCleverInsultsIntentRequestHandler extends AbstractRequestHandler
{
    /**
     * @var classyCleverInsults
     */
    private $classyCleverInsults;
    /**
     * @var ResponseHelper
     */
    private $responseHelper;
    /**
     * @param ResponseHelper $responseHelper
     */
    public function __construct(ResponseHelper $responseHelper)
    {
        $this->responseHelper          = $responseHelper;
        $this->supportedApplicationIds = ['amzn1.ask.skill.6e748299-5ea1-4924-890a-e98ee4c19cae'];
        $this->classyCleverInsults = array();
        array_push($this->classyCleverInsults, "I do desire we may be better strangers.");
        array_push($this->classyCleverInsults, "You consistently meet my expectations.");
        array_push($this->classyCleverInsults, "Your ability to speak does not make you intelligent.");
        array_push($this->classyCleverInsults, "If you were half as funny as you thought you were, you'd be twice as funny as you are.");
        array_push($this->classyCleverInsults, "You’re not the dumbest person in the world, but you better hope he doesn’t die.");
        array_push($this->classyCleverInsults, "I hope your day is filled with people like you.");
        array_push($this->classyCleverInsults, "I hope your day is as pleasant as you.");
        array_push($this->classyCleverInsults, "It is impossible to underestimate you.");
        array_push($this->classyCleverInsults, "All I know is one of us is right, and the other one is you.");
        array_push($this->classyCleverInsults, "Are you an organ donor? I'd hate for your life to be a total waste.");
        array_push($this->classyCleverInsults, "I'd agree with you, but then we would both be wrong.");
        array_push($this->classyCleverInsults, "I've been called worse things by better people.");
        array_push($this->classyCleverInsults, "I envy everyone you have never met.");
        array_push($this->classyCleverInsults, "Life is full of disappointments, just ask your parents.");
        array_push($this->classyCleverInsults, "You remind me of someone. They weren't very memorable.");
        array_push($this->classyCleverInsults, "Your contribution led to quantum leaps in improvements.");
        array_push($this->classyCleverInsults, "I would challenge you to a dual of wits but I see you are unarmed.");
        array_push($this->classyCleverInsults, "If I wanted to commit suicide I'd jump from your ego to your IQ.");
        array_push($this->classyCleverInsults, "You are aware that people simply tolerate you?");
        array_push($this->classyCleverInsults, "I can explain it to you but I can't understand it for you.");
        array_push($this->classyCleverInsults, "As an outsider, what's your perspective on intelligence?");
    }
    /**
     * {@inheritdoc}
     */
    public function supportsRequest(Request $request): bool
    {
        return $request->request instanceOf MaxBeckers\AmazonAlexa\Request\Request\Standard\IntentRequest &&
        'ask_classy_and_clever_insult' === $request->request->intent->name;
    }
    /**
     * {@inheritdoc}
     */
    public function handleRequest(Request $request): Response
    {
        $classyCleverInsult = $this->classyCleverInsults[array_rand($this->classyCleverInsults)];
        return $this->responseHelper->respond($classyCleverInsult);
    }
}