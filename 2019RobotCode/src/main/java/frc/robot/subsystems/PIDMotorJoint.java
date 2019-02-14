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

public class PIDMotorJoint extends PIDSubsystem {
  private double m_encoderPerAngle, m_zeroEncoder, m_targetAngle, m_maxAngle, m_minAngle, m_zeroAngle, m_maxSpeed,
      m_length;
  private CANSparkMax m_jointMotor;
  public CANEncoder m_jointEncoder;
  private boolean m_reverse;
  private DigitalInput m_frontSwitch, m_backSwitch;
  private double m_prevEncoder, m_currEncoder;

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

    m_prevEncoder = m_jointEncoder.getPosition();

    m_zeroEncoder = 0;

    resetAngle();
  }

  public void resetAngle() {
    // System.out.println(m_jointEncoder.getPosition());
    m_zeroEncoder = m_jointEncoder.getPosition();
    setSetpoint(0);
  }

  public double getHeight(double angle) {
    return Math.sin(angle) * m_length;
  }

  @Override
  protected void initDefaultCommand() {

  }

  @Override
  protected double returnPIDInput() {
    return getAngle();
  }

  @Override
  protected void usePIDOutput(double output) {
    //System.out.println(this.getName() + ": " + getAngle());
    if (outOfBounds(getAngle())) {
      System.out.println("out of bounds");
      hold();
    } else {
      //System.out.println(this.getName() + " t: " + m_targetAngle + " c: " + getAngle());
      if (m_reverse)
        output *= -1;
      if (output > m_maxSpeed)
        output = m_maxSpeed;
      if (output < -m_maxSpeed)
        output = -m_maxSpeed;
      //System.out.println(this.getName() + " :" + output);
      m_jointMotor.set(output);
    } 
  }

  public boolean outOfBounds(double angle) {
    if (angle <= m_minAngle) {
      return true;
    } else if (angle >= m_maxAngle) {
      return true;
    } else if (m_frontSwitch.get() || m_backSwitch.get()) {
      return false;
    }
    return false;
  }

  public double getAngle() {
    m_currEncoder = m_jointEncoder.getPosition();
    if (Math.abs(m_currEncoder) < 0.001){
      m_currEncoder = m_prevEncoder;
    } else {
      m_prevEncoder = m_currEncoder;
    }
    if (m_reverse){
      return (-(m_currEncoder - m_zeroEncoder) / m_encoderPerAngle) + m_zeroAngle;
    } else {
      return ((m_currEncoder - m_zeroEncoder) / m_encoderPerAngle) + m_zeroAngle;
    }
  }

  public boolean reachedDestination(){
    System.out.println(getAngle() - m_targetAngle);
    return Math.abs(getAngle() - m_targetAngle) < 5;
  }

  public void setAngle(double targetAngle) {
    //System.out.println(targetAngle);
    if (!outOfBounds(targetAngle)){
      m_targetAngle = targetAngle;
      setSetpoint(m_targetAngle);
    } else {
      System.out.println("this angle is out of bounds");
    }
  }

  public void hold() {
    setAngle(getAngle()); 
  }
}
