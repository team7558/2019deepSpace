/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.subsystems;

import edu.wpi.first.wpilibj.DigitalInput;
import edu.wpi.first.wpilibj.command.PIDSubsystem;
import com.revrobotics.CANEncoder;
import com.revrobotics.CANSparkMax;

import com.revrobotics.CANSparkMaxLowLevel.MotorType;

import frc.robot.Robot;

import frc.robot.RobotMap;

public class PIDMotorJoint extends PIDSubsystem {
  private double m_encoderPerAngle, m_zeroEncoder, m_targetAngle, m_maxAngle, m_minAngle, m_zeroAngle, m_maxSpeed,
      m_length;
  private CANSparkMax m_jointMotor, m_jointMotor2;
  public CANEncoder m_jointEncoder;
  private boolean m_reverse;
  private DigitalInput m_frontSwitch, m_backSwitch;
  private double m_prevEncoder, m_currEncoder;
  private boolean hasTwoMotors;
  public boolean m_hold;
  

  public PIDMotorJoint(String subsystemName, CANSparkMax jointMotor, double encoderPerAngle, double maxAngle,
      double minAngle, double zeroAngle, double kP, double kD, double kI, boolean reverse, double maxSpeed,
      double length, int frontSwitch, int backSwitch) {

    super(subsystemName, kP, kD, kI);

    m_jointMotor = jointMotor;
    m_jointEncoder = new CANEncoder(m_jointMotor);
    m_encoderPerAngle = encoderPerAngle;
    m_maxAngle = maxAngle;
    m_minAngle = minAngle;
    m_zeroAngle = zeroAngle;
    m_reverse = reverse;
    m_maxSpeed = maxSpeed;
    m_length = length;
    m_frontSwitch = new DigitalInput(frontSwitch);
    m_backSwitch = new DigitalInput(backSwitch);

    hasTwoMotors = false;

    m_hold = false;

    m_prevEncoder = m_jointEncoder.getPosition();

    m_zeroEncoder = 0;

    resetAngle();
  }

  public PIDMotorJoint(String subsystemName, CANSparkMax jointMotor, CANSparkMax jointMotor2, double encoderPerAngle, double maxAngle,
      double minAngle, double zeroAngle, double kP, double kD, double kI, boolean reverse, double maxSpeed,
      double length, int frontSwitch, int backSwitch) {

    super(subsystemName, kP, kD, kI);

    m_jointMotor = jointMotor;
    m_jointMotor2 = jointMotor2;
    m_jointEncoder = new CANEncoder(m_jointMotor);
    m_encoderPerAngle = encoderPerAngle;
    m_maxAngle = maxAngle;
    m_minAngle = minAngle;
    m_zeroAngle = zeroAngle;
    m_reverse = reverse;
    m_maxSpeed = maxSpeed;
    m_length = length;
    m_frontSwitch = new DigitalInput(frontSwitch);
    m_backSwitch = new DigitalInput(backSwitch);

    m_hold = false;

    hasTwoMotors = false;

    m_prevEncoder = m_jointEncoder.getPosition();

    m_zeroEncoder = 0;

    resetAngle();
  }

  public void resetAngle() {
    // System.out.println(m_jointEncoder.getPosition());
    m_zeroEncoder = m_jointEncoder.getPosition();
    setAngle(getAngle());
  }

  public double getLength() {
    return m_length;
  }

  @Override
  protected void initDefaultCommand() {

  }

  @Override
  protected double returnPIDInput() {
    checkOutOfBounds();
/*
    if (this.getName().equals("elbow")) {
      System.out.println("current: " + this.getAngle() + "goal: " + this.getSetpoint());
    }
*/
    return getAngle();
  }

  @Override
  protected void usePIDOutput(double output) {
    if (m_reverse)
      output *= -1;
    if (output > m_maxSpeed)
      output = m_maxSpeed;
    if (output < -m_maxSpeed)
      output = -m_maxSpeed;
    if (!this.getName().equals("wrist")) {
      System.out.println(output);
      m_jointMotor.set(output);
      if(hasTwoMotors){
        m_jointMotor2.set(output);
      }
    }
  }

  public void checkOutOfBounds() {

    boolean goingUp = m_targetAngle - getAngle() >= 0;
    /*
     * if (getAngle() <= m_minAngle) { hold(); } else if (getAngle() >= m_maxAngle)
     * { hold(); }
     */
    if (goingUp && !m_backSwitch.get()) {
      //System.out.println("saladaadas");
      resetAngle();
      hold();
    } else if (!goingUp && !m_frontSwitch.get()) {
      hold();
    } else {
      m_hold = false;
      setAngle(m_targetAngle);
    }

  }

  public double getAngle() {
    m_currEncoder = m_jointEncoder.getPosition();
    if (Math.abs(m_currEncoder) < 0.001) {
      m_currEncoder = m_prevEncoder;
    } else {
      m_prevEncoder = m_currEncoder;
    }
    if (m_reverse) {
      return (-(m_currEncoder - m_zeroEncoder) / m_encoderPerAngle) + m_zeroAngle;
    } else {
      return ((m_currEncoder - m_zeroEncoder) / m_encoderPerAngle) + m_zeroAngle;
    }
  }

  public boolean reachedDestination() {
    return Math.abs(getAngle() - m_targetAngle) < 10;
  }

  public void setAngle(double targetAngle) {
    // if (Math.abs(m_targetAngle - targetAngle) > 0){
    m_targetAngle = targetAngle;
    setSetpoint(m_targetAngle);
  }

  public void hold() {
    m_hold = true;
    setSetpoint(getAngle());
  }
}
