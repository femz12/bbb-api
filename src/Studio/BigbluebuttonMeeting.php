<?php

namespace DavidO\BBBApi;

use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\Parameters\EndMeetingParameters;
use BigBlueButton\Parameters\GetMeetingInfoParameters;
use BigBlueButton\Parameters\GetRecordingsParameters;
use BigBlueButton\Parameters\JoinMeetingParameters;
use DavidO\BBBApi\Contracts\Meeting;

class BigbluebuttonMeeting implements Meeting
{
    /**
     * @var BigBlueButton
     */
    protected $bbb;

    public function __construct(BigBlueButton $bbb)
    {
        $this->bbb = $bbb;
    }

    /**
     *  Return a list of all meetings
     *
     * @return mixed
     */
    public function all()
    {
        $response = $this->bbb->getMeetings();

        return $response->getReturnCode() == 'SUCCESS' ? $response->getRawXml()->meetings->meeting : false;
    }

    /**
     * @param  \BigBlueButton\Parameters\CreateMeetingParameters  $meeting
     * @return bool
     */
    public function create(CreateMeetingParameters $meeting)
    {
        return $this->bbb->createMeeting($meeting)->getReturnCode() != 'FAILED';
    }

    /**
     *  Join meeting
     *
     * @param  \BigBlueButton\Parameters\JoinMeetingParameters  $meeting
     * @return string
     */
    public function join(JoinMeetingParameters $meeting)
    {
        return $this->bbb->getJoinMeetingURL($meeting);
    }

    /**
     *  Returns information about the meeting
     *
     * @param  \BigBlueButton\Parameters\GetMeetingInfoParameters  $meeting
     * @return bool|\SimpleXMLElement
     */
    public function get(GetMeetingInfoParameters $meeting)
    {
        $response = $this->bbb->getMeetingInfo($meeting);

        return $response->getReturnCode() !== 'FAILED' ? $response->getRawXml() : false;
    }

    /**
     *  Close meeting
     *
     * @param  \BigBlueButton\Parameters\EndMeetingParameters  $meeting
     * @return \BigBlueButton\Responses\EndMeetingResponse
     */
    public function close(EndMeetingParameters $meeting)
    {
        return $this->bbb->endMeeting($meeting);
    }

    /**
     * @param  \BigBlueButton\Parameters\GetRecordingsParameters  $recording
     * @return mixed
     */
    public function getRecording(GetRecordingsParameters $recording)
    {
        $response = $this->bbb->getRecordings($recording);

        return $response->getReturnCode() == 'SUCCESS' ? $response->getRawXml()->recordings->recording : false;
    }
}
